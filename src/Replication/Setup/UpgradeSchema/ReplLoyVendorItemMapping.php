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

class ReplLoyVendorItemMapping
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $table_name = $setup->getTable( 'ls_replication_repl_loy_vendor_item_mapping' ); 
        if(!$setup->tableExists($table_name)) {
        	$table = $setup->getConnection()->newTable( $table_name );
        	$table->addColumn('repl_loy_vendor_item_mapping_id', Table::TYPE_INTEGER, 11, [ 'identity' => TRUE, 'primary' => TRUE, 'unsigned' => TRUE, 'nullable' => FALSE, 'auto_increment'=> TRUE ]);
        	$table->addColumn('scope', Table::TYPE_TEXT, 8);
        	$table->addColumn('scope_id', Table::TYPE_INTEGER, 11);
        	$table->addColumn('processed', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already copied into Magento. 0 means needs to be copied into Magento tables & 1 means already copied');
        	$table->addColumn('is_updated', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already updated from Omni into Magento. 0 means already updated & 1 means needs to be updated into Magento tables');
        	$table->addColumn('is_failed', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already added from Flat into Magento successfully or not. 0 means already added successfully & 1 means failed to add successfully into Magento tables');
        	$table->addColumn('Deleted' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('DisplayOrder' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('IsDeleted' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('IsFeaturedProduct' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('NavManufacturerId' , Table::TYPE_TEXT, '');
        	$table->addColumn('NavManufacturerItemId' , Table::TYPE_TEXT, '');
        	$table->addColumn('NavProductId' , Table::TYPE_TEXT, '');
        	$table->addColumn('created_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT ], 'Created At');
        	$table->addColumn('updated_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE ], 'Updated At');
        	$setup->getConnection()->createTable( $table );
        } else {
        	$connection = $setup->getConnection();
        	if ($connection->tableColumnExists($table_name, 'Deleted' ) === false) {
        		$connection->addColumn($table_name, 'Deleted', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'Deleted']);
        	}
        	if ($connection->tableColumnExists($table_name, 'DisplayOrder' ) === false) {
        		$connection->addColumn($table_name, 'DisplayOrder', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'DisplayOrder']);
        	}
        	if ($connection->tableColumnExists($table_name, 'IsDeleted' ) === false) {
        		$connection->addColumn($table_name, 'IsDeleted', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'IsDeleted']);
        	}
        	if ($connection->tableColumnExists($table_name, 'IsFeaturedProduct' ) === false) {
        		$connection->addColumn($table_name, 'IsFeaturedProduct', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'IsFeaturedProduct']);
        	}
        	if ($connection->tableColumnExists($table_name, 'NavManufacturerId' ) === false) {
        		$connection->addColumn($table_name, 'NavManufacturerId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'NavManufacturerId']);
        	}
        	if ($connection->tableColumnExists($table_name, 'NavManufacturerItemId' ) === false) {
        		$connection->addColumn($table_name, 'NavManufacturerItemId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'NavManufacturerItemId']);
        	}
        	if ($connection->tableColumnExists($table_name, 'NavProductId' ) === false) {
        		$connection->addColumn($table_name, 'NavProductId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'NavProductId']);
        	}
        	if ($connection->tableColumnExists($table_name, 'is_failed' ) === false) {
        		$connection->addColumn($table_name, 'is_failed', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'Is_failed']);
        	}
        }
    }


}

