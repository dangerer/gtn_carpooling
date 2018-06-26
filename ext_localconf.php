<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'GTN.' . $_EXTKEY,
	'Trip',
	array(
		'Trip' => 'list, show, new, create, edit, update, delete, publish, unpublish, confirm, sendMessage, search',

	),
	// non-cacheable actions
	array(
		'Trip' => 'show, list, new, edit, update, create, publish, unpublish, delete, sendMessage, confirm, search',

	)
);
