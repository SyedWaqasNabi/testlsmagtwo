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

class ReplExtendedVariantValue
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $table_name = $setup->getTable( 'ls_replication_repl_extended_variant_value' ); 
        if(!$setup->tableExists($table_name)) {
        	$table = $setup->getConnection()->newTable( $table_name );
        	$table->addColumn('repl_extended_variant_value_id', Table::TYPE_INTEGER, 11, [ 'identity' => TRUE, 'primary' => TRUE, 'unsigned' => TRUE, 'nullable' => FALSE, 'auto_increment'=> TRUE ]);
        	$table->addColumn('scope', Table::TYPE_TEXT, 8);
        	$table->addColumn('scope_id', Table::TYPE_INTEGER, 11);
        	$table->addColumn('processed', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already copied into Magento. 0 means needs to be copied into Magento tables & 1 means already copied');
        	$table->addColumn('is_updated', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already updated from Omni into Magento. 0 means already updated & 1 means needs to be updated into Magento tables');
        	$table->addColumn('is_failed', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already added from Flat into Magento successfully or not. 0 means already added successfully & 1 means failed to add successfully into Magento tables');
        	$table->addColumn('Code' , Table::TYPE_TEXT, '');
        	$table->addColumn('DimensionLogicalOrder' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('Dimensions' , Table::TYPE_TEXT, '');
        	$table->addColumn('FrameworkCode' , Table::TYPE_TEXT, '');
        	$table->addColumn('IsDeleted' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('ItemId' , Table::TYPE_TEXT, '');
        	$table->addColumn('LogicalOrder' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('Timestamp' , Table::TYPE_TEXT, '');
        	$table->addColumn('Value' , Table::TYPE_TEXT, '');
        	$table->addColumn('scope' , Table::TYPE_TEXT, '');
        	$table->addColumn('scope_id' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('checksum', Table::TYPE_TEXT,'');
        	$table->addColumn('processed_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => true ], 'Processed At');
        	$table->addColumn('created_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT ], 'Created At');
        	$table->addColumn('updated_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE ], 'Updated At');
        	$setup->getConnection()->createTable( $table );
        } else {
        	$connection = $setup->getConnection();
        	if ($connection->tableColumnExists($table_name, 'Code' ) === false) {
        		$connection->addColumn($table_name, 'Code', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Code']);
        	} else {
        		$connection->modifyColumn($table_name, 'Code', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Code']);
        	}
        	if ($connection->tableColumnExists($table_name, 'DimensionLogicalOrder' ) === false) {
        		$connection->addColumn($table_name, 'DimensionLogicalOrder', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'DimensionLogicalOrder']);
        	} else {
        		$connection->modifyColumn($table_name, 'DimensionLogicalOrder', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'DimensionLogicalOrder']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Dimensions' ) === false) {
        		$connection->addColumn($table_name, 'Dimensions', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Dimensions']);
        	} else {
        		$connection->modifyColumn($table_name, 'Dimensions', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Dimensions']);
        	}
        	if ($connection->tableColumnExists($table_name, 'FrameworkCode' ) === false) {
        		$connection->addColumn($table_name, 'FrameworkCode', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'FrameworkCode']);
        	} else {
        		$connection->modifyColumn($table_name, 'FrameworkCode', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'FrameworkCode']);
        	}
        	if ($connection->tableColumnExists($table_name, 'IsDeleted' ) === false) {
        		$connection->addColumn($table_name, 'IsDeleted', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'IsDeleted']);
        	} else {
        		$connection->modifyColumn($table_name, 'IsDeleted', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'IsDeleted']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ItemId' ) === false) {
        		$connection->addColumn($table_name, 'ItemId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'ItemId']);
        	} else {
        		$connection->modifyColumn($table_name, 'ItemId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'ItemId']);
        	}
        	if ($connection->tableColumnExists($table_name, 'LogicalOrder' ) === false) {
        		$connection->addColumn($table_name, 'LogicalOrder', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'LogicalOrder']);
        	} else {
        		$connection->modifyColumn($table_name, 'LogicalOrder', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'LogicalOrder']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Timestamp' ) === false) {
        		$connection->addColumn($table_name, 'Timestamp', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Timestamp']);
        	} else {
        		$connection->modifyColumn($table_name, 'Timestamp', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Timestamp']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Value' ) === false) {
        		$connection->addColumn($table_name, 'Value', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Value']);
        	} else {
        		$connection->modifyColumn($table_name, 'Value', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Value']);
        	}
        	if ($connection->tableColumnExists($table_name, 'scope' ) === false) {
        		$connection->addColumn($table_name, 'scope', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Scope']);
        	} else {
        		$connection->modifyColumn($table_name, 'scope', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Scope']);
        	}
        	if ($connection->tableColumnExists($table_name, 'scope_id' ) === false) {
        		$connection->addColumn($table_name, 'scope_id', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'Scope_id']);
        	} else {
        		$connection->modifyColumn($table_name, 'scope_id', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'Scope_id']);
        	}
        	if ($connection->tableColumnExists($table_name, 'processed' ) === false) {
        		$connection->addColumn($table_name, 'processed', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'Flag to check if data is already copied into Magento. 0 means needs to be copied into Magento tables & 1 means already copied']);
        	} else {
        		$connection->modifyColumn($table_name, 'processed', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'Flag to check if data is already copied into Magento. 0 means needs to be copied into Magento tables & 1 means already copied']);
        	}
        	if ($connection->tableColumnExists($table_name, 'is_updated' ) === false) {
        		$connection->addColumn($table_name, 'is_updated', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'Flag to check if data is already updated from Omni into Magento. 0 means already updated & 1 means needs to be updated into Magento tables']);
        	} else {
        		$connection->modifyColumn($table_name, 'is_updated', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'Flag to check if data is already updated from Omni into Magento. 0 means already updated & 1 means needs to be updated into Magento tables']);
        	}
        	if ($connection->tableColumnExists($table_name, 'is_failed' ) === false) {
        		$connection->addColumn($table_name, 'is_failed', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'Flag to check if data is already added from Flat into Magento successfully or not. 0 means already added successfully & 1 means failed to add successfully into Magento tables']);
        	} else {
        		$connection->modifyColumn($table_name, 'is_failed', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'Flag to check if data is already added from Flat into Magento successfully or not. 0 means already added successfully & 1 means failed to add successfully into Magento tables']);
        	}
        	if ($connection->tableColumnExists($table_name, 'checksum' ) === false) {
        		$connection->addColumn($table_name, 'checksum', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Checksum']);
        	} else {
        		$connection->modifyColumn($table_name, 'checksum', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Checksum']);
        	}
        	if ($connection->tableColumnExists($table_name, 'processed_at' ) === false) {
        		$connection->addColumn($table_name, 'processed_at', ['length' => '','default' => null,'type' => Table::TYPE_TIMESTAMP, 'comment' => 'Processed At']);
        	} else {
        		$connection->modifyColumn($table_name, 'processed_at', ['length' => '','default' => null,'type' => Table::TYPE_TIMESTAMP, 'comment' => 'Processed At']);
        	}
        	if ($connection->tableColumnExists($table_name, 'created_at' ) === false) {
        		$connection->addColumn($table_name, 'created_at', ['length' => '','default' => Table::TIMESTAMP_INIT,'type' => Table::TYPE_TIMESTAMP, 'comment' => 'Created At']);
        	} else {
        		$connection->modifyColumn($table_name, 'created_at', ['length' => '','default' => Table::TIMESTAMP_INIT,'type' => Table::TYPE_TIMESTAMP, 'comment' => 'Created At']);
        	}
        	if ($connection->tableColumnExists($table_name, 'updated_at' ) === false) {
        		$connection->addColumn($table_name, 'updated_at', ['length' => '','default' => Table::TIMESTAMP_INIT_UPDATE,'type' => Table::TYPE_TIMESTAMP, 'comment' => 'Updated At']);
        	} else {
        		$connection->modifyColumn($table_name, 'updated_at', ['length' => '','default' => Table::TIMESTAMP_INIT_UPDATE,'type' => Table::TYPE_TIMESTAMP, 'comment' => 'Updated At']);
        	}
        }
    }


}

