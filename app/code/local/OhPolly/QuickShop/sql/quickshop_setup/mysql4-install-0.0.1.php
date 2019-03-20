<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
CREATE TABLE a_ohpolly_quickshop ( id mediumint(5) NOT NULL AUTO_INCREMENT, image_name varchar(255) NOT NULL, link text NOT NULL COMMENT 'URLs can be longer than 2000 symbols, which is why "text" is the more appropriate type for this field', PRIMARY KEY (id), UNIQUE KEY id (id) );
SQLTEXT;

$installer->run($sql);
// Create the JSON file perhaps ?
$installer->endSetup();
	 