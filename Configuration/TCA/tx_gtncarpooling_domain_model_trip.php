<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:gtn_carpooling/Resources/Private/Language/locallang_db.xlf:tx_gtncarpooling_domain_model_trip',
		'label' => 'trip_date',
		'label_alt' => 'city_start,city_destination,last_name',
		'label_alt_force' => 1,
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'first_name,last_name,email,phone,trip_date,city_start,zip_start,city_destination,zip_destination,publish_hash,delete_hash,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('gtn_carpooling') . 'Resources/Public/Icons/tx_gtncarpooling_domain_model_trip.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, first_name, last_name, email, phone, trip_date, city_start, zip_start, city_destination, zip_destination, publish_hash, delete_hash',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, first_name, last_name, email, phone, trip_date, city_start, zip_start, city_destination, zip_destination, publish_hash, delete_hash, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_gtncarpooling_domain_model_trip',
				'foreign_table_where' => 'AND tx_gtncarpooling_domain_model_trip.pid=###CURRENT_PID### AND tx_gtncarpooling_domain_model_trip.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'first_name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:gtn_carpooling/Resources/Private/Language/locallang_db.xlf:tx_gtncarpooling_domain_model_trip.first_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'last_name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:gtn_carpooling/Resources/Private/Language/locallang_db.xlf:tx_gtncarpooling_domain_model_trip.last_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'email' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:gtn_carpooling/Resources/Private/Language/locallang_db.xlf:tx_gtncarpooling_domain_model_trip.email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'phone' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:gtn_carpooling/Resources/Private/Language/locallang_db.xlf:tx_gtncarpooling_domain_model_trip.phone',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'trip_date' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:gtn_carpooling/Resources/Private/Language/locallang_db.xlf:tx_gtncarpooling_domain_model_trip.trip_date',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'datetime,required',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'city_start' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:gtn_carpooling/Resources/Private/Language/locallang_db.xlf:tx_gtncarpooling_domain_model_trip.city_start',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'zip_start' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:gtn_carpooling/Resources/Private/Language/locallang_db.xlf:tx_gtncarpooling_domain_model_trip.zip_start',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'city_destination' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:gtn_carpooling/Resources/Private/Language/locallang_db.xlf:tx_gtncarpooling_domain_model_trip.city_destination',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'zip_destination' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:gtn_carpooling/Resources/Private/Language/locallang_db.xlf:tx_gtncarpooling_domain_model_trip.zip_destination',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'publish_hash' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:gtn_carpooling/Resources/Private/Language/locallang_db.xlf:tx_gtncarpooling_domain_model_trip.publish_hash',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'delete_hash' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:gtn_carpooling/Resources/Private/Language/locallang_db.xlf:tx_gtncarpooling_domain_model_trip.delete_hash',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:gtn_cachedevents/Resources/Private/Language/locallang_db.xlf:tx_gtncachedevents_domain_model_event.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
			),
		),
        'has_need' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:gtn_cachedevents/Resources/Private/Language/locallang_db.xlf:tx_gtncachedevents_domain_model_event.hasNeed',
            'config' => array(
                'type' => 'check',
            ),
        ),

		
	),
);