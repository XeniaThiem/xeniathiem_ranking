CREATE TABLE tx_xeniathiemranking_domain_model_rankingoption (
	title varchar(255) DEFAULT '' NOT NULL,
	collection varchar(255) DEFAULT '' NOT NULL,
	collectiondisplay int(11) unsigned NOT NULL default '1',
	image int(11) unsigned NOT NULL default '0',
	link varchar(255) DEFAULT '' NOT NULL,
	parentid int(11) unsigned DEFAULT '0' NOT NULL,
	parenttable varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_xeniathiemranking_domain_model_section (
	title varchar(255) DEFAULT '' NOT NULL,
	rankingoptions int(11) NOT NULL default '0',
	parentid int(11) unsigned DEFAULT '0' NOT NULL,
	parenttable varchar(255) DEFAULT '' NOT NULL
);
