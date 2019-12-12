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

class ReplItemVariantRegistration
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $table_name = $setup->getTable( 'ls_replication_repl_item_variant_registration' ); 
        if(!$setup->tableExists($table_name)) {
        	$table = $setup->getConnection()->newTable( $table_name );
        	$table->addColumn('repl_item_variant_registration_id', Table::TYPE_INTEGER, 11, [ 'identity' => TRUE, 'primary' => TRUE, 'unsigned' => TRUE, 'nullable' => FALSE, 'auto_increment'=> TRUE ]);
        	$table->addColumn('scope', Table::TYPE_TEXT, 8);
        	$table->addColumn('scope_id', Table::TYPE_INTEGER, 11);
        	$table->addColumn('processed', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already copied into Magento. 0 means needs to be copied into Magento tables & 1 means already copied');
        	$table->addColumn('is_updated', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already updated from Omni into Magento. 0 means already updated & 1 means needs to be updated into Magento tables');
        	$table->addColumn('is_failed', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already added from Flat into Magento successfully or not. 0 means already added successfully & 1 means failed to add successfully into Magento tables');
        	$table->addColumn('FrameworkCode' , Table::TYPE_TEXT, '');
        	$table->addColumn('IsDeleted' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('ItemId' , Table::TYPE_TEXT, '');
        	$table->addColumn('VariantDimension1' , Table::TYPE_TEXT, '');
        	$table->addColumn('VariantDimension2' , Table::TYPE_TEXT, '');
        	$table->addColumn('VariantDimension3' , Table::TYPE_TEXT, '');
        	$table->addColumn('VariantDimension4' , Table::TYPE_TEXT, '');
        	$table->addColumn('VariantDimension5' , Table::TYPE_TEXT, '');
        	$table->addColumn('VariantDimension6' , Table::TYPE_TEXT, '');
        	$table->addColumn('VariantId' , Table::TYPE_TEXT, '');
        	$table->addColumn('created_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT ], 'Created At');
        	$table->addColumn('updated_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE ], 'Updated At');
        	$setup->getConnection()->createTable( $table );
        } else {
        	$connection = $setup->getConnection();
        	if ($connection->tableColumnExists($table_name, 'FrameworkCode' ) === false) {
        		$connection->addColumn($table_name, 'FrameworkCode', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'FrameworkCode']);
        	}
        	if ($connection->tableColumnExists($table_name, 'IsDeleted' ) === false) {
        		$connection->addColumn($table_name, 'IsDeleted', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'IsDeleted']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ItemId' ) === false) {
        		$connection->addColumn($table_name, 'ItemId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'ItemId']);
        	}
        	if ($connection->tableColumnExists($table_name, 'VariantDimension1' ) === false) {
        		$connection->addColumn($table_name, 'VariantDimension1', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'VariantDimension1']);
        	}
        	if ($connection->tableColumnExists($table_name, 'VariantDimension2' ) === false) {
        		$connection->addColumn($table_name, 'VariantDimension2', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'VariantDimension2']);
        	}
        	if ($connection->tableColumnExists($table_name, 'VariantDimension3' ) === false) {
        		$connection->addColumn($table_name, 'VariantDimension3', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'VariantDimension3']);
        	}
        	if ($connection->tableColumnExists($table_name, 'VariantDimension4' ) === false) {
        		$connection->addColumn($table_name, 'VariantDimension4', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'VariantDimension4']);
        	}
        	if ($connection->tableColumnExists($table_name, 'VariantDimension5' ) === false) {
        		$connection->addColumn($table_name, 'VariantDimension5', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'VariantDimension5']);
        	}
        	if ($connection->tableColumnExists($table_name, 'VariantDimension6' ) === false) {
        		$connection->addColumn($table_name, 'VariantDimension6', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'VariantDimension6']);
        	}
        	if ($connection->tableColumnExists($table_name, 'VariantId' ) === false) {
        		$connection->addColumn($table_name, 'VariantId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'VariantId']);
        	}
        	if ($connection->tableColumnExists($table_name, 'is_failed' ) === false) {
        		$connection->addColumn($table_name, 'is_failed', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'Is_failed']);
        	}
        }
    }


}

