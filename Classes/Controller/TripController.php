<?php
namespace GTN\GtnCarpooling\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Sergey Zavarzin <szavarzin@gtn-solutions.com>, Gtn solutions
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use TYPO3\CMS\Backend\Form\Utility\FormEngineUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * TripController
 */
class TripController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * tripRepository
     * 
     * @var \GTN\GtnCarpooling\Domain\Repository\TripRepository
     * @inject
     */
    protected $tripRepository = NULL;

    /**
     * @var \TYPO3\CMS\Extbase\Security\Cryptography\HashService
     * @inject
     */
    protected $hashService;

    /**
     * persistenceManager
     *
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     * @inject
     */
    protected $persistenceManager = null;


    public function initializeAction()
    {
        $querySettings = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface::class);
        $querySettings->setRespectStoragePage(false);

        $dateFormat = $this->settings['dateFormat'];
        // mapping for new Trip or edit Trip
        $cases = array('trip', 'newTrip');
        foreach($cases as $case) {
            if (isset($this->arguments[$case])) {
                $mappingConfiguration = $this->arguments[$case]->getPropertyMappingConfiguration();
                $mappingConfiguration->forProperty('tripDate')
                    ->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',
                        \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, $dateFormat);
            }
        }
        $pageRenderer = $GLOBALS['TSFE']->getPageRenderer();
        //$pageRenderer =\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
        $pageRenderer->loadJquery();
        if (!$this->settings['doNotLoadDateTimePickerJavascript']) {
            $pageRenderer->addCssFile($this->settings['pathToDateTimePickerCss']);
            $pageRenderer->addJsFooterFile($this->settings['pathToMomentJavaScript']);
            $pageRenderer->addJsFooterFile($this->settings['pathToMomentLocaleJavaScript']);
            $pageRenderer->addJsFooterFile($this->settings['pathToDateTimePickerJavaScript']);
        }
        $pageRenderer->addCssFile($this->settings['pathToControllerCss']);
        $pageRenderer->addJsFooterFile($this->settings['pathToControllerJavaScript']);
    }

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $trips = $this->tripRepository->findFuture();
        $this->view->assign('trips', $trips);
    }
    
    /**
     * action show
     * 
     * @param \GTN\GtnCarpooling\Domain\Model\Trip $trip
     * @return void
     */
    public function showAction(\GTN\GtnCarpooling\Domain\Model\Trip $trip)
    {
        $this->view->assign('trip', $trip);
    }
    
    /**
     * action new
     *
     * @param \GTN\GtnCarpooling\Domain\Model\Trip $newTrip
     * @return void
     */
    public function newAction($newTrip = NULL)
    {
/*        if ($newTrip === NULL) {
            $newTrip = $this->objectManager->getEmptyObject(\GTN\GtnCarpooling\Domain\Model\Trip::class);
            if ($this->settings['defaultFormValues']) {
                foreach($this->settings['defaultFormValues'] as $paramName => $value) {
                    $newTrip->{'set'.ucfirst($paramName)}($value);
                }
            }
            DebuggerUtility::var_dump($newTrip);
        }
        $this->view->assign('newTrip', $newTrip);*/
        $this->assignToView($this->view);
    }
    
    /**
     * action create
     * 
     * @param \GTN\GtnCarpooling\Domain\Model\Trip $newTrip
     * @return void
     */
    public function createAction(\GTN\GtnCarpooling\Domain\Model\Trip $newTrip)
    {
//        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $deleteHash = md5(GeneralUtility::generateRandomBytes(64));
        $newTrip->setDeleteHash($deleteHash);
        $publishHash = md5(GeneralUtility::generateRandomBytes(64));
        $newTrip->setPublishHash($publishHash);
        // params by default
        if ($this->settings['defaultValues']) {
            foreach($this->settings['defaultValues'] as $paramName => $value) {
                $newTrip->{'set'.ucfirst($paramName)}($value);
            }
        }
        $this->tripRepository->add($newTrip);
        $this->persistenceManager->persistAll();
        $this->sendEmailAfterTripCreated($newTrip, $this->settings['sendActivationEmail']);
        $this->redirect('confirm', null, null, array('tripUid' => $newTrip->getUid()));
//        if ($this->settings['listPid']>0)
//            $this->redirect('list', null, null, null, $this->settings['listPid']);
//        $this->redirect('list');
    }

    /**
     * @param int $tripUid
     */
    public function confirmAction($tripUid = 0) {
        $trip = $this->tripRepository->findByUidWithHidden($tripUid);
        $this->view->assign('trip', $trip);
        $this->view->assign('sendEmailActivation', $this->settings['sendEmailActivation']);
        $this->view->assign('listPid', $this->settings['listPid']);
    }
    
    /**
     * action edit
     * 
     * @param \GTN\GtnCarpooling\Domain\Model\Trip $trip
     * @ignorevalidation $trip
     * @return void
     */
    public function editAction(\GTN\GtnCarpooling\Domain\Model\Trip $trip)
    {
        $this->view->assign('trip', $trip);
    }
    
    /**
     * action update
     * 
     * @param \GTN\GtnCarpooling\Domain\Model\Trip $trip
     * @return void
     */
    public function updateAction(\GTN\GtnCarpooling\Domain\Model\Trip $trip)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->tripRepository->update($trip);
        $this->redirect('list');
    }
    
    /**
     * action delete
     * 
     * @return void
     */
    public function deleteAction()
    {
        $confirm = GeneralUtility::_GP('confirmDelete');
        $this->view->assign('confirmDelete', $confirm);
        $gp = GeneralUtility::_GP('tx_gtncarpooling_trip');

        if (!$gp['trip'])
            return false;
        if (!$trip = $this->tripRepository->findByUidWithHidden($gp['trip']))
            return false;

        $deleteHash = GeneralUtility::_GP('deleteHash');
        $this->view->assign('trip', $trip);
        if ($confirm && $deleteHash==$trip->getDeleteHash())
            $this->tripRepository->remove($trip);
//        $this->redirect('list');
    }
    
    /**
     * action publish
     *
     * @return void
     */
    public function publishAction()
    {
        $gp = GeneralUtility::_GP('tx_gtncarpooling_trip');
        if (!$gp['trip'])
            return false;
        if (!$trip = $this->tripRepository->findByUidWithHidden($gp['trip']))
            return false;
        $publishHash = GeneralUtility::_GP('publishHash');
        if ($publishHash == $trip->getPublishHash()) {
            $trip->setHidden(0);
            $this->tripRepository->update($trip);
        }
        $this->view->assign('trip', $trip);
    }
    
    /**
     * action unpublish
     * 
     * @return void
     */
    public function unpublishAction()
    {
        
    }

    /**
     * Additional objects to the view
     * @param $view
     */
    public function assignToView(&$view) {
        // required fields
        $requiredFields = GeneralUtility::trimExplode(',', $this->settings['requiredFields']);
        foreach ($requiredFields as $fieldName) {
            $assignRequiredFields[$fieldName] = 1;
        }

        $view->assign('requiredFields', $assignRequiredFields);
    }

    /**
     * @param \GTN\GtnCarpooling\Domain\Model\Trip $trip
     * @param bool $sendEmailActivation
     */
    public function sendEmailAfterTripCreated($trip, $sendEmailActivation = false) {
        /* @var \GTN\GtnCarpooling\Service\MailService $mailService */
        $mailService = $this->objectManager->get('GTN\\GtnCarpooling\\Service\\MailService');

        $variables = array(
            'trip' => $trip,
            'sendEmailActivation' => $sendEmailActivation
        );

        $mailService->sendTemplateEmail(
            array($trip->getEmail() => $trip->getFirstName().' '.$trip->getLastName()),
            array($this->settings['adminEmail'] => $this->settings['adminName']),
            \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_gtncarpooling.email.subjectAfterTripCreated', 'gtn_carpooling'),
            'TripCreatedNotification',
            $variables
        );
    }

    /**
     * send message
     *
     * @param \GTN\GtnCarpooling\Domain\Model\Trip $trip
     * @param array $passenger
     * @return void
     */
    public function sendMessageAction($trip, $passenger)
    {
//        DebuggerUtility::var_dump($passenger);
        $this->view->assign('trip', $trip);

        $checkPassenger = $this->checkPassenger($passenger);
        $validationResults = null;
        if (count($checkPassenger) > 0) {
            $validationResults = array();
            foreach ($checkPassenger as $fieldName => $message) {
                $validationResults['passenger'][$fieldName] = $message;
            }
            $this->view->assign('myValidationResults', $validationResults);
        } else {
            $this->sendEmailContactForm($trip, $passenger);
            $this->view->assign('successMessage', \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_gtncarpooling.contactForm.messageSended', 'gtn_carpooling'));
        }
        $this->view->assign('passenger', $passenger);
//        DebuggerUtility::var_dump($checkPassenger);
    }

    /**
     * check passenger (contact from) values
     * @param array $passenger
     */
    public function checkPassenger($passenger) {
        $errors = array();
        // required fields
        $requiredFields = GeneralUtility::trimExplode(',', $this->settings['contactFormRequiredFields']);
        foreach ($requiredFields as $fieldName) {
            if (!$passenger[$fieldName]) {
                $message = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_gtncarpooling.errorMessages.contactForm.'.$fieldName, 'gtn_carpooling');
                if ($message != '')
                    $errors[$fieldName] = $message;
                else
                    $errors[$fieldName] = ' Create erorr message for \''.$fieldName.'\' field in the locallang.xlf for contactForm';
            }
        }
        // check valid email
        if (in_array('email', $requiredFields) && !array_key_exists('email', $errors))
            if (!\TYPO3\CMS\Core\Utility\GeneralUtility::validEmail($passenger['email']))
                $errors['email'] = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_gtncarpooling.errorMessages.contactForm.email', 'gtn_carpooling');
        return $errors;
    }


    /**
     * @param \GTN\GtnCarpooling\Domain\Model\Trip $trip
     * @param array $passenger
     */
    public function sendEmailContactForm($trip, $passenger) {
        /* @var \GTN\GtnCarpooling\Service\MailService $mailService */
        $mailService = $this->objectManager->get('GTN\\GtnCarpooling\\Service\\MailService');

        $variables = array(
            'trip' => $trip,
            'contactForm' => $passenger
        );

        $mailService->sendTemplateEmail(
            array($trip->getEmail() => $trip->getFirstName().' '.$trip->getLastName()),
            array($passenger['email'] => $passenger['firstName'].' '.$passenger['lastName']),
            \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_gtncarpooling.email.subjectTripContactForm', 'gtn_carpooling'),
            'TripContactFormNotification',
            $variables
        );
    }

}