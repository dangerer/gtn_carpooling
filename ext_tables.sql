#
# Table structure for table 'tx_gtncarpooling_domain_model_trip'
#
CREATE TABLE tx_gtncarpooling_domain_model_trip (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	first_name varchar(255) DEFAULT '' NOT NULL,
	last_name varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	phone varchar(255) DEFAULT '' NOT NULL,
	trip_date int(11) DEFAULT '0' NOT NULL,
	city_start varchar(255) DEFAULT '' NOT NULL,
	zip_start int(11) DEFAULT '0' NOT NULL,
	city_destination varchar(255) DEFAULT '' NOT NULL,
	zip_destination int(11) DEFAULT '0' NOT NULL,
	publish_hash varchar(255) DEFAULT '' NOT NULL,
	delete_hash varchar(255) DEFAULT '' NOT NULL,
	description TEXT,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),

 KEY language (l10n_parent,sys_language_uid)

);
