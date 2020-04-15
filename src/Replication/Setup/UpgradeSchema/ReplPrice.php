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

class ReplPrice
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $table_name = $setup->getTable( 'ls_replication_repl_price' ); 
        if(!$setup->tableExists($table_name)) {
        	$table = $setup->getConnection()->newTable( $table_name );
        	$table->addColumn('repl_price_id', Table::TYPE_INTEGER, 11, [ 'identity' => TRUE, 'primary' => TRUE, 'unsigned' => TRUE, 'nullable' => FALSE, 'auto_increment'=> TRUE ]);
        	$table->addColumn('scope', Table::TYPE_TEXT, 8);
        	$table->addColumn('scope_id', Table::TYPE_INTEGER, 11);
        	$table->addColumn('processed', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already copied into Magento. 0 means needs to be copied into Magento tables & 1 means already copied');
        	$table->addColumn('is_updated', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already updated from Omni into Magento. 0 means already updated & 1 means needs to be updated into Magento tables');
        	$table->addColumn('is_failed', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already added from Flat into Magento successfully or not. 0 means already added successfully & 1 means failed to add successfully into Magento tables');
        	$table->addColumn('CurrencyCode' , Table::TYPE_TEXT, '');
        	$table->addColumn('CustomerDiscountGroup' , Table::TYPE_TEXT, '');
        	$table->addColumn('EndingDate' , Table::TYPE_TEXT, '');
        	$table->addColumn('IsDeleted' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('ItemId' , Table::TYPE_TEXT, '');
        	$table->addColumn('LoyaltySchemeCode' , Table::TYPE_TEXT, '');
        	$table->addColumn('MinimumQuantity' , Table::TYPE_DECIMAL, '20,4');
        	$table->addColumn('ModifyDate' , Table::TYPE_TEXT, '');
        	$table->addColumn('PriceInclVat' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('Priority' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('QtyPerUnitOfMeasure' , Table::TYPE_DECIMAL, '20,4');
        	$table->addColumn('SaleCode' , Table::TYPE_TEXT, '');
        	$table->addColumn('SaleType' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('StartingDate' , Table::TYPE_TEXT, '');
        	$table->addColumn('StoreId' , Table::TYPE_TEXT, '');
        	$table->addColumn('UnitOfMeasure' , Table::TYPE_TEXT, '');
        	$table->addColumn('UnitPrice' , Table::TYPE_DECIMAL, '20,4');
        	$table->addColumn('UnitPriceInclVat' , Table::TYPE_DECIMAL, '20,4');
        	$table->addColumn('VATPostGroup' , Table::TYPE_TEXT, '');
        	$table->addColumn('VariantId' , Table::TYPE_TEXT, '');
        	$table->addColumn('scope' , Table::TYPE_TEXT, '');
        	$table->addColumn('scope_id' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('checksum', Table::TYPE_TEXT,'');
        	$table->addColumn('processed_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => true ], 'Processed At');
        	$table->addColumn('created_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT ], 'Created At');
        	$table->addColumn('updated_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE ], 'Updated At');
        	$setup->getConnection()->createTable( $table );
        } else {
        	$connection = $setup->getConnection();
        	if ($connection->tableColumnExists($table_name, 'CurrencyCode' ) === false) {
        		$connection->addColumn($table_name, 'CurrencyCode', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'CurrencyCode']);
        	} else {
        		$connection->modifyColumn($table_name, 'CurrencyCode', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'CurrencyCode']);
        	}
        	if ($connection->tableColumnExists($table_name, 'CustomerDiscountGroup' ) === false) {
        		$connection->addColumn($table_name, 'CustomerDiscountGroup', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'CustomerDiscountGroup']);
        	} else {
        		$connection->modifyColumn($table_name, 'CustomerDiscountGroup', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'CustomerDiscountGroup']);
        	}
        	if ($connection->tableColumnExists($table_name, 'EndingDate' ) === false) {
        		$connection->addColumn($table_name, 'EndingDate', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'EndingDate']);
        	} else {
        		$connection->modifyColumn($table_name, 'EndingDate', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'EndingDate']);
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
        	if ($connection->tableColumnExists($table_name, 'LoyaltySchemeCode' ) === false) {
        		$connection->addColumn($table_name, 'LoyaltySchemeCode', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'LoyaltySchemeCode']);
        	} else {
        		$connection->modifyColumn($table_name, 'LoyaltySchemeCode', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'LoyaltySchemeCode']);
        	}
        	if ($connection->tableColumnExists($table_name, 'MinimumQuantity' ) === false) {
        		$connection->addColumn($table_name, 'MinimumQuantity', ['length' => '20,4','default' => null,'type' => Table::TYPE_DECIMAL, 'comment' => 'MinimumQuantity']);
        	} else {
        		$connection->modifyColumn($table_name, 'MinimumQuantity', ['length' => '20,4','default' => null,'type' => Table::TYPE_DECIMAL, 'comment' => 'MinimumQuantity']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ModifyDate' ) === false) {
        		$connection->addColumn($table_name, 'ModifyDate', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'ModifyDate']);
        	} else {
        		$connection->modifyColumn($table_name, 'ModifyDate', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'ModifyDate']);
        	}
        	if ($connection->tableColumnExists($table_name, 'PriceInclVat' ) === false) {
        		$connection->addColumn($table_name, 'PriceInclVat', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'PriceInclVat']);
        	} else {
        		$connection->modifyColumn($table_name, 'PriceInclVat', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'PriceInclVat']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Priority' ) === false) {
        		$connection->addColumn($table_name, 'Priority', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'Priority']);
        	} else {
        		$connection->modifyColumn($table_name, 'Priority', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'Priority']);
        	}
        	if ($connection->tableColumnExists($table_name, 'QtyPerUnitOfMeasure' ) === false) {
        		$connection->addColumn($table_name, 'QtyPerUnitOfMeasure', ['length' => '20,4','default' => null,'type' => Table::TYPE_DECIMAL, 'comment' => 'QtyPerUnitOfMeasure']);
        	} else {
        		$connection->modifyColumn($table_name, 'QtyPerUnitOfMeasure', ['length' => '20,4','default' => null,'type' => Table::TYPE_DECIMAL, 'comment' => 'QtyPerUnitOfMeasure']);
        	}
        	if ($connection->tableColumnExists($table_name, 'SaleCode' ) === false) {
        		$connection->addColumn($table_name, 'SaleCode', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'SaleCode']);
        	} else {
        		$connection->modifyColumn($table_name, 'SaleCode', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'SaleCode']);
        	}
        	if ($connection->tableColumnExists($table_name, 'SaleType' ) === false) {
        		$connection->addColumn($table_name, 'SaleType', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'SaleType']);
        	} else {
        		$connection->modifyColumn($table_name, 'SaleType', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'SaleType']);
        	}
        	if ($connection->tableColumnExists($table_name, 'StartingDate' ) === false) {
        		$connection->addColumn($table_name, 'StartingDate', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'StartingDate']);
        	} else {
        		$connection->modifyColumn($table_name, 'StartingDate', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'StartingDate']);
        	}
        	if ($connection->tableColumnExists($table_name, 'StoreId' ) === false) {
        		$connection->addColumn($table_name, 'StoreId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'StoreId']);
        	} else {
        		$connection->modifyColumn($table_name, 'StoreId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'StoreId']);
        	}
        	if ($connection->tableColumnExists($table_name, 'UnitOfMeasure' ) === false) {
        		$connection->addColumn($table_name, 'UnitOfMeasure', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'UnitOfMeasure']);
        	} else {
        		$connection->modifyColumn($table_name, 'UnitOfMeasure', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'UnitOfMeasure']);
        	}
        	if ($connection->tableColumnExists($table_name, 'UnitPrice' ) === false) {
        		$connection->addColumn($table_name, 'UnitPrice', ['length' => '20,4','default' => null,'type' => Table::TYPE_DECIMAL, 'comment' => 'UnitPrice']);
        	} else {
        		$connection->modifyColumn($table_name, 'UnitPrice', ['length' => '20,4','default' => null,'type' => Table::TYPE_DECIMAL, 'comment' => 'UnitPrice']);
        	}
        	if ($connection->tableColumnExists($table_name, 'UnitPriceInclVat' ) === false) {
        		$connection->addColumn($table_name, 'UnitPriceInclVat', ['length' => '20,4','default' => null,'type' => Table::TYPE_DECIMAL, 'comment' => 'UnitPriceInclVat']);
        	} else {
        		$connection->modifyColumn($table_name, 'UnitPriceInclVat', ['length' => '20,4','default' => null,'type' => Table::TYPE_DECIMAL, 'comment' => 'UnitPriceInclVat']);
        	}
        	if ($connection->tableColumnExists($table_name, 'VATPostGroup' ) === false) {
        		$connection->addColumn($table_name, 'VATPostGroup', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'VATPostGroup']);
        	} else {
        		$connection->modifyColumn($table_name, 'VATPostGroup', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'VATPostGroup']);
        	}
        	if ($connection->tableColumnExists($table_name, 'VariantId' ) === false) {
        		$connection->addColumn($table_name, 'VariantId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'VariantId']);
        	} else {
        		$connection->modifyColumn($table_name, 'VariantId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'VariantId']);
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

