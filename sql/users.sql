/* MYSQL */
CREATE TABLE IF NOT EXISTS users (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  role_id int(11) NOT NULL DEFAULT '2',
  email varchar(120) NOT NULL,
  firstName  varchar(255) DEFAULT NULL,
  lastName  varchar(255) DEFAULT NULL,
  username varchar(30) DEFAULT NULL,
  password char(60) NOT NULL,
  salt varchar(40) DEFAULT NULL,
  activation_code varchar(40) DEFAULT NULL,
  birthday date  DEFAULT NULL,
  forgotten_password_code varchar(40) DEFAULT NULL,
  forgotten_password_time int(11) unsigned DEFAULT NULL,
  reset_hash varchar(40) DEFAULT NULL,
  last_login date  DEFAULT NULL,
  last_ip varchar(40) DEFAULT NULL,
  created_on date  DEFAULT NULL,
  deleted tinyint(1) NOT NULL DEFAULT '0',
  reset_by int(10) DEFAULT NULL,
  banned tinyint(1) NOT NULL DEFAULT '0',
  ban_message varchar(255) DEFAULT NULL,
  timezone char(4) NOT NULL DEFAULT 'UM6',
  language varchar(20) NOT NULL DEFAULT 'english',
  active tinyint(1) NOT NULL DEFAULT '0',
  force_password_reset tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  KEY email (email)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 

INSERT INTO `users`(`role_id`, `firstName`, `lastName`, `email`, `username`, `password`, `salt`, `activation_code`, `birthday`, `last_ip`, `created_on`) VALUES (1,
'admin','admin','admin@admin.com','admin admin' , '$2y$12$8mVh7XbwUC0rjNBy9D7j5OJGdWnWH0q/6d4N/gBDRelmvkdZ.0aMq
    [salt] => $2y$12$Tuq1gJ07LslAZdaOI.w/U.' , '$2y$12$Tuq1gJ07LslAZdaOI.w/U.' , '$2y$12$XSmaLO4jP62TStHQEo85Cu' , '1995-10-01', '50.43.90.82', '2013-10-30')

/* MSSQL */

CREATE TABLE IF NOT EXISTS users (
  id int NOT NULL PRIMARY KEY IDENTITY,
  role_id int NOT NULL DEFAULT '4',
  email  nvarchar(120) NOT NULL,
  firstName  nvarchar(80) NOT NULL,
  lastName  nvarchar(80) NOT NULL,
  userName  nvarchar(30) NOT NULL DEFAULT '',
  birthday DATE DEFAULT NULL,
  password  nvarchar(max) NOT NULL,
  last_login DATE DEFAULT NULL,
  last_ip  nvarchar(40) DEFAULT NULL,
  created_on DATE DEFAULT NULL,
  deleted int NOT NULL DEFAULT '0',
  reset_by int DEFAULT NULL,
  banned int NOT NULL DEFAULT '0',
  ban_message  nvarchar(255) DEFAULT NULL,
  language varchar(20) NOT NULL DEFAULT 'english',
  active int NOT NULL DEFAULT '0',
  force_password_reset int NOT NULL DEFAULT '0'
)