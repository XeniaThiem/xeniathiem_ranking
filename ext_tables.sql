CREATE TABLE tx_xeniathiemranking_domain_model_rankingoption (
	title varchar(255) DEFAULT '' NOT NULL,
	image int(11) unsigned NOT NULL default '0',
	link varchar(255) DEFAULT '' NOT NULL,
	parentid int(11) unsigned DEFAULT '0' NOT NULL,
	parenttable varchar(255) DEFAULT '' NOT NULL
);
