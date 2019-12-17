<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Replication\Setup\UpgradeSchema;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class ReplDataTranslation
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $table_name = $setup->getTable( 'ls_replication_repl_data_translation' ); 
        if(!$setup->tableExists($table_name)) {
        	$table = $setup->getConnection()->newTable( $table_name );
        	$table->addColumn('repl_data_translation_id', Table::TYPE_INTEGER, 11, [ 'identity' => TRUE, 'primary' => TRUE, 'unsigned' => TRUE, 'nullable' => FALSE, 'auto_increment'=> TRUE ]);
        	$table->addColumn('scope', Table::TYPE_TEXT, 8);
        	$table->addColumn('scope_id', Table::TYPE_INTEGER, 11);
        	$table->addColumn('processed', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already copied into Magento. 0 means needs to be copied into Magento tables & 1 means already copied');
        	$table->addColumn('is_updated', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already updated from Omni into Magento. 0 means already updated & 1 means needs to be updated into Magento tables');
        	$table->addColumn('is_failed', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already added from Flat into Magento successfully or not. 0 means already added successfully & 1 means failed to add successfully into Magento tables');
        	$table->addColumn('IsDeleted' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('Key' , Table::TYPE_TEXT, '');
        	$table->addColumn('LanguageCode' , Table::TYPE_TEXT, '');
        	$table->addColumn('Text' , Table::TYPE_TEXT, '');
        	$table->addColumn('TranslationId' , Table::TYPE_TEXT, '');
        	$table->addColumn('created_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT ], 'Created At');
        	$table->addColumn('updated_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE ], 'Updated At');
        	$setup->getConnection()->createTable( $table );
        } else {
        	$connection = $setup->getConnection();
        	if ($connection->tableColumnExists($table_name, 'IsDeleted' ) === false) {
        		$connection->addColumn($table_name, 'IsDeleted', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'IsDeleted']);
        	} else {
        		$connection->modifyColumn($table_name, 'IsDeleted', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'IsDeleted']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Key' ) === false) {
        		$connection->addColumn($table_name, 'Key', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Key']);
        	} else {
        		$connection->modifyColumn($table_name, 'Key', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Key']);
        	}
        	if ($connection->tableColumnExists($table_name, 'LanguageCode' ) === false) {
        		$connection->addColumn($table_name, 'LanguageCode', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'LanguageCode']);
        	} else {
        		$connection->modifyColumn($table_name, 'LanguageCode', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'LanguageCode']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Text' ) === false) {
        		$connection->addColumn($table_name, 'Text', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Text']);
        	} else {
        		$connection->modifyColumn($table_name, 'Text', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Text']);
        	}
        	if ($connection->tableColumnExists($table_name, 'TranslationId' ) === false) {
        		$connection->addColumn($table_name, 'TranslationId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'TranslationId']);
        	} else {
        		$connection->modifyColumn($table_name, 'TranslationId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'TranslationId']);
        	}
        	if ($connection->tableColumnExists($table_name, 'is_failed' ) === false) {
        		$connection->addColumn($table_name, 'is_failed', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'Is_failed']);
        	} else {
        		$connection->modifyColumn($table_name, 'is_failed', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'Is_failed']);
        	}
        }
    }


}

