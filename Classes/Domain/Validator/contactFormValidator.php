<?php
namespace GTN\GtnCarpooling\Domain\Validator;

	/***************************************************************
	 *  Copyright notice
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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * Subject validator
 */
class ContactFormValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

	/**
	 * Object Manager
	 *
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
	 * @inject
	 *
	 */
	protected $objectManager;

	/**
	 * @var \TYPO3\CMS\Extbase\Mvc\Request
	 * @inject
	 */
	protected $request;


	/**
	 * Validates the given value
	 *
	 * @param mixed $value
	 * @return bool
	 * @api
	 */
	protected function isValid($value) {
		$validationResult = $this->validateContactForm($value);
//		DebuggerUtility::var_dump($validationResult );
		$success = TRUE;
		foreach ($validationResult as $key => $validateResult) {
			$error = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Validation\\Error', $validateResult, time());
			$this->result->forProperty($key)->addError($error);
			$success = FALSE;
		}
		return $success;
	}

	/**
	 * @param array $trip
	 * @return array
	 */
	protected function validateContactForm(array $trip) {
		$errors = array();

		/* @var $objectManager \TYPO3\CMS\Extbase\Object\ObjectManager */
		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		/* @var $configurationManager \TYPO3\CMS\Extbase\Configuration\ConfigurationManager */
		$configurationManager = $objectManager->get(ConfigurationManager::class);
		$TSsettings = $configurationManager->getConfiguration(
			ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS
		);
		$requiredFields = GeneralUtility::trimExplode(',', $TSsettings['contactFormRequiredFields']);
//		DebuggerUtility::var_dump($trip);
//		 check required fields
		foreach($requiredFields as $fieldName) {
			// required values
			if ( ! $trip[$fieldName]) {
				$message = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_gtncarpooling.errorMessages.contactForm.'.$fieldName, 'gtn_carpooling');
				if ($message != '')
					$errors[$fieldName] = $message;
				else
					$errors[$fieldName] = ' Create erorr message for \''.$fieldName.'\' field in the locallang.xlf for contact form';
			}
		}
		// check valid email
		if (in_array('email', $requiredFields) && !array_key_exists('email', $errors))
			if (!\TYPO3\CMS\Core\Utility\GeneralUtility::validEmail($trip->getEmail()))
				$errors['email'] = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_gtncarpooling.errorMessages.contactForm.email', 'gtn_carpooling');

		return $errors;
	}
}
?>