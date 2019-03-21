<?php

// The alternative to setup the MySQL table would be to invoke the Varien API functions like so:

// $installer=$this;
// $installer->startSetup();
// $table=$installer->getConnection()->newTable($installer->getTable('quickshop/quickshop'))
// 	->addColumn(
// 		'id',Varien_Db_Ddl_Table::TYPE_INTEGER,null,array(
// 			'auto_increment'=>true,
// 			'identity'=>true,
// 			'unsigned'=>true,
// 			'nullable'=>false,
// 			'primary'=>true
// 			),'ID')
// 	->addColumn('image_name',Varien_Db_Ddl_Table::TYPE_TEXT,100,array('nullable'=>false),'Image Name')
//     ->addColumn('link',Varien_Db_Ddl_Table::TYPE_TEXT,100,array('nullable'=>false),'Target URL');

// if(!$installer->getConnection()->isTableExists($table->getName())){
// 	$installer->getConnection()->createTable($table);
// }
// $installer->endSetup();