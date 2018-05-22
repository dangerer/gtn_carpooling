<?php
namespace GTN\GtnCarpooling\Service;
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
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * This class simulates an external API call to validate data
 *
 */
class MailService implements \TYPO3\CMS\Core\SingletonInterface {

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
	 * @inject
	 */
	protected $objectManager;


	/**
	 * @param array $recipient recipient of the email in the format array('recipient@domain.tld' => 'Recipient Name')
	 * @param array $sender sender of the email in the format array('sender@domain.tld' => 'Sender Name')
	 * @param string $subject subject of the email
	 * @param string $templateName template name (UpperCamelCase)
	 * @param array $variables variables to be passed to the Fluid view
	 * @return boolean TRUE on success, otherwise false
	 */
	public function sendTemplateEmail(array $recipient, array $sender, $subject, $templateName, array $variables = array(), $attachments = null) {
		$configurationManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManagerInterface');
		$extbaseFrameworkConfiguration = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
		$extbaseFrameworkConfiguration = $extbaseFrameworkConfiguration['plugin.']['tx_gtncarpooling_trip.'];
		if(empty($extbaseFrameworkConfiguration['view']['templateRootPath'])){
			$extbaseFrameworkConfiguration['view']['templateRootPath'] = $extbaseFrameworkConfiguration['view.']['templateRootPaths.'][0];
		}
		$templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
//		DebuggerUtility::var_dump($templateRootPath);

//		DebuggerUtility::var_dump($sender);
		/** @var \TYPO3\CMS\Fluid\View\StandaloneView $emailView */
		$emailView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
		$templatePathAndFilename = $templateRootPath . 'Emails/' . $templateName . '.html';
		$emailView->setTemplatePathAndFilename($templatePathAndFilename);
		$emailView->assignMultiple($variables); // assign Fluid variable
		$emailBody = $emailView->render();
//		DebuggerUtility::var_dump($subject);
//		DebuggerUtility::var_dump($emailBody);
//		echo $emailBody;
//		exit;
		/** @var $message \TYPO3\CMS\Core\Mail\MailMessage */
		$message = $this->objectManager->get('TYPO3\\CMS\\Core\\Mail\\MailMessage');
		$message->setTo($recipient)
			->setFrom($sender)
			->setSubject($subject);

		// Possible attachments here
		/*if (count($attachments)) {
            foreach ($attachments as $file => $name) {
                if (file_exists($file)) {
                    if (trim($name)) {
                        $message->attach(\Swift_Attachment::fromPath($file)->setFilename($name));
                    } else {
                        $message->attach(Swift_Attachment::fromPath($file));
                    }
                }
            }
        }*/

		// Plain text example
		//$message->setBody($emailBody, 'text/plain');

		// HTML Email
		$message->setBody($emailBody, 'text/html');

		$message->send();
		return $message->isSent();
	}


}
?>