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

class ReplItem
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $table_name = $setup->getTable( 'ls_replication_repl_item' ); 
        if(!$setup->tableExists($table_name)) {
        	$table = $setup->getConnection()->newTable( $table_name );
        	$table->addColumn('repl_item_id', Table::TYPE_INTEGER, 11, [ 'identity' => TRUE, 'primary' => TRUE, 'unsigned' => TRUE, 'nullable' => FALSE, 'auto_increment'=> TRUE ]);
        	$table->addColumn('BaseUnitOfMeasure' , Table::TYPE_TEXT, '');
        	$table->addColumn('BlockDiscount' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('BlockDistribution' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('BlockManualPriceChange' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('BlockNegativeAdjustment' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('BlockPositiveAdjustment' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('BlockPurchaseReturn' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('Blocked' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('BlockedOnPos' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('CrossSellingExists' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('DateBlocked' , Table::TYPE_TEXT, '');
        	$table->addColumn('DateToActivateItem' , Table::TYPE_TEXT, '');
        	$table->addColumn('Description' , Table::TYPE_TEXT, '');
        	$table->addColumn('Details' , Table::TYPE_TEXT, '');
        	$table->addColumn('GrossWeight' , Table::TYPE_DECIMAL, '20,4');
        	$table->addColumn('nav_id' , Table::TYPE_TEXT, '');
        	$table->addColumn('IsDeleted' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('ItemCategoryCode' , Table::TYPE_TEXT, '');
        	$table->addColumn('ItemFamilyCode' , Table::TYPE_TEXT, '');
        	$table->addColumn('KeyingInPrice' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('KeyingInQty' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('MustKeyInComment' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('NoDiscountAllowed' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('ProductGroupId' , Table::TYPE_TEXT, '');
        	$table->addColumn('PurchUnitOfMeasure' , Table::TYPE_TEXT, '');
        	$table->addColumn('SalseUnitOfMeasure' , Table::TYPE_TEXT, '');
        	$table->addColumn('ScaleItem' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('SeasonCode' , Table::TYPE_TEXT, '');
        	$table->addColumn('TaxItemGroupId' , Table::TYPE_TEXT, '');
        	$table->addColumn('UnitPrice' , Table::TYPE_DECIMAL, '20,4');
        	$table->addColumn('UnitVolume' , Table::TYPE_DECIMAL, '20,4');
        	$table->addColumn('UnitsPerParcel' , Table::TYPE_DECIMAL, '20,4');
        	$table->addColumn('VendorId' , Table::TYPE_TEXT, '');
        	$table->addColumn('VendorItemId' , Table::TYPE_TEXT, '');
        	$table->addColumn('ZeroPriceValId' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('scope' , Table::TYPE_TEXT, '');
        	$table->addColumn('scope_id' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('processed', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already copied into Magento. 0 means needs to be copied into Magento tables & 1 means already copied');
        	$table->addColumn('is_updated', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already updated from Omni into Magento. 0 means already updated & 1 means needs to be updated into Magento tables');
        	$table->addColumn('is_failed', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already added from Flat into Magento successfully or not. 0 means already added successfully & 1 means failed to add successfully into Magento tables');
        	$table->addColumn('checksum', Table::TYPE_TEXT,'');
        	$table->addColumn('processed_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => true ], 'Processed At');
        	$table->addColumn('created_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT ], 'Created At');
        	$table->addColumn('updated_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE ], 'Updated At');
        	$setup->getConnection()->createTable( $table );
        } else {
        	$connection = $setup->getConnection();
        	if ($connection->tableColumnExists($table_name, 'BaseUnitOfMeasure' ) === false) {
        		$connection->addColumn($table_name, 'BaseUnitOfMeasure', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'BaseUnitOfMeasure']);
        	} else {
        		$connection->modifyColumn($table_name, 'BaseUnitOfMeasure', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'BaseUnitOfMeasure']);
        	}
        	if ($connection->tableColumnExists($table_name, 'BlockDiscount' ) === false) {
        		$connection->addColumn($table_name, 'BlockDiscount', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'BlockDiscount']);
        	} else {
        		$connection->modifyColumn($table_name, 'BlockDiscount', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'BlockDiscount']);
        	}
        	if ($connection->tableColumnExists($table_name, 'BlockDistribution' ) === false) {
        		$connection->addColumn($table_name, 'BlockDistribution', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'BlockDistribution']);
        	} else {
        		$connection->modifyColumn($table_name, 'BlockDistribution', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'BlockDistribution']);
        	}
        	if ($connection->tableColumnExists($table_name, 'BlockManualPriceChange' ) === false) {
        		$connection->addColumn($table_name, 'BlockManualPriceChange', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'BlockManualPriceChange']);
        	} else {
        		$connection->modifyColumn($table_name, 'BlockManualPriceChange', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'BlockManualPriceChange']);
        	}
        	if ($connection->tableColumnExists($table_name, 'BlockNegativeAdjustment' ) === false) {
        		$connection->addColumn($table_name, 'BlockNegativeAdjustment', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'BlockNegativeAdjustment']);
        	} else {
        		$connection->modifyColumn($table_name, 'BlockNegativeAdjustment', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'BlockNegativeAdjustment']);
        	}
        	if ($connection->tableColumnExists($table_name, 'BlockPositiveAdjustment' ) === false) {
        		$connection->addColumn($table_name, 'BlockPositiveAdjustment', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'BlockPositiveAdjustment']);
        	} else {
        		$connection->modifyColumn($table_name, 'BlockPositiveAdjustment', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'BlockPositiveAdjustment']);
        	}
        	if ($connection->tableColumnExists($table_name, 'BlockPurchaseReturn' ) === false) {
        		$connection->addColumn($table_name, 'BlockPurchaseReturn', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'BlockPurchaseReturn']);
        	} else {
        		$connection->modifyColumn($table_name, 'BlockPurchaseReturn', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'BlockPurchaseReturn']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Blocked' ) === false) {
        		$connection->addColumn($table_name, 'Blocked', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'Blocked']);
        	} else {
        		$connection->modifyColumn($table_name, 'Blocked', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'Blocked']);
        	}
        	if ($connection->tableColumnExists($table_name, 'BlockedOnPos' ) === false) {
        		$connection->addColumn($table_name, 'BlockedOnPos', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'BlockedOnPos']);
        	} else {
        		$connection->modifyColumn($table_name, 'BlockedOnPos', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'BlockedOnPos']);
        	}
        	if ($connection->tableColumnExists($table_name, 'CrossSellingExists' ) === false) {
        		$connection->addColumn($table_name, 'CrossSellingExists', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'CrossSellingExists']);
        	} else {
        		$connection->modifyColumn($table_name, 'CrossSellingExists', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'CrossSellingExists']);
        	}
        	if ($connection->tableColumnExists($table_name, 'DateBlocked' ) === false) {
        		$connection->addColumn($table_name, 'DateBlocked', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'DateBlocked']);
        	} else {
        		$connection->modifyColumn($table_name, 'DateBlocked', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'DateBlocked']);
        	}
        	if ($connection->tableColumnExists($table_name, 'DateToActivateItem' ) === false) {
        		$connection->addColumn($table_name, 'DateToActivateItem', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'DateToActivateItem']);
        	} else {
        		$connection->modifyColumn($table_name, 'DateToActivateItem', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'DateToActivateItem']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Description' ) === false) {
        		$connection->addColumn($table_name, 'Description', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Description']);
        	} else {
        		$connection->modifyColumn($table_name, 'Description', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Description']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Details' ) === false) {
        		$connection->addColumn($table_name, 'Details', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Details']);
        	} else {
        		$connection->modifyColumn($table_name, 'Details', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Details']);
        	}
        	if ($connection->tableColumnExists($table_name, 'GrossWeight' ) === false) {
        		$connection->addColumn($table_name, 'GrossWeight', ['length' => '20,4','default' => null,'type' => Table::TYPE_DECIMAL, 'comment' => 'GrossWeight']);
        	} else {
        		$connection->modifyColumn($table_name, 'GrossWeight', ['length' => '20,4','default' => null,'type' => Table::TYPE_DECIMAL, 'comment' => 'GrossWeight']);
        	}
        	if ($connection->tableColumnExists($table_name, 'nav_id' ) === false) {
        		$connection->addColumn($table_name, 'nav_id', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Nav_id']);
        	} else {
        		$connection->modifyColumn($table_name, 'nav_id', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Nav_id']);
        	}
        	if ($connection->tableColumnExists($table_name, 'IsDeleted' ) === false) {
        		$connection->addColumn($table_name, 'IsDeleted', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'IsDeleted']);
        	} else {
        		$connection->modifyColumn($table_name, 'IsDeleted', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'IsDeleted']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ItemCategoryCode' ) === false) {
        		$connection->addColumn($table_name, 'ItemCategoryCode', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'ItemCategoryCode']);
        	} else {
        		$connection->modifyColumn($table_name, 'ItemCategoryCode', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'ItemCategoryCode']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ItemFamilyCode' ) === false) {
        		$connection->addColumn($table_name, 'ItemFamilyCode', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'ItemFamilyCode']);
        	} else {
        		$connection->modifyColumn($table_name, 'ItemFamilyCode', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'ItemFamilyCode']);
        	}
        	if ($connection->tableColumnExists($table_name, 'KeyingInPrice' ) === false) {
        		$connection->addColumn($table_name, 'KeyingInPrice', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'KeyingInPrice']);
        	} else {
        		$connection->modifyColumn($table_name, 'KeyingInPrice', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'KeyingInPrice']);
        	}
        	if ($connection->tableColumnExists($table_name, 'KeyingInQty' ) === false) {
        		$connection->addColumn($table_name, 'KeyingInQty', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'KeyingInQty']);
        	} else {
        		$connection->modifyColumn($table_name, 'KeyingInQty', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'KeyingInQty']);
        	}
        	if ($connection->tableColumnExists($table_name, 'MustKeyInComment' ) === false) {
        		$connection->addColumn($table_name, 'MustKeyInComment', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'MustKeyInComment']);
        	} else {
        		$connection->modifyColumn($table_name, 'MustKeyInComment', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'MustKeyInComment']);
        	}
        	if ($connection->tableColumnExists($table_name, 'NoDiscountAllowed' ) === false) {
        		$connection->addColumn($table_name, 'NoDiscountAllowed', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'NoDiscountAllowed']);
        	} else {
        		$connection->modifyColumn($table_name, 'NoDiscountAllowed', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'NoDiscountAllowed']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ProductGroupId' ) === false) {
        		$connection->addColumn($table_name, 'ProductGroupId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'ProductGroupId']);
        	} else {
        		$connection->modifyColumn($table_name, 'ProductGroupId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'ProductGroupId']);
        	}
        	if ($connection->tableColumnExists($table_name, 'PurchUnitOfMeasure' ) === false) {
        		$connection->addColumn($table_name, 'PurchUnitOfMeasure', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'PurchUnitOfMeasure']);
        	} else {
        		$connection->modifyColumn($table_name, 'PurchUnitOfMeasure', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'PurchUnitOfMeasure']);
        	}
        	if ($connection->tableColumnExists($table_name, 'SalseUnitOfMeasure' ) === false) {
        		$connection->addColumn($table_name, 'SalseUnitOfMeasure', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'SalseUnitOfMeasure']);
        	} else {
        		$connection->modifyColumn($table_name, 'SalseUnitOfMeasure', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'SalseUnitOfMeasure']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ScaleItem' ) === false) {
        		$connection->addColumn($table_name, 'ScaleItem', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'ScaleItem']);
        	} else {
        		$connection->modifyColumn($table_name, 'ScaleItem', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'ScaleItem']);
        	}
        	if ($connection->tableColumnExists($table_name, 'SeasonCode' ) === false) {
        		$connection->addColumn($table_name, 'SeasonCode', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'SeasonCode']);
        	} else {
        		$connection->modifyColumn($table_name, 'SeasonCode', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'SeasonCode']);
        	}
        	if ($connection->tableColumnExists($table_name, 'TaxItemGroupId' ) === false) {
        		$connection->addColumn($table_name, 'TaxItemGroupId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'TaxItemGroupId']);
        	} else {
        		$connection->modifyColumn($table_name, 'TaxItemGroupId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'TaxItemGroupId']);
        	}
        	if ($connection->tableColumnExists($table_name, 'UnitPrice' ) === false) {
        		$connection->addColumn($table_name, 'UnitPrice', ['length' => '20,4','default' => null,'type' => Table::TYPE_DECIMAL, 'comment' => 'UnitPrice']);
        	} else {
        		$connection->modifyColumn($table_name, 'UnitPrice', ['length' => '20,4','default' => null,'type' => Table::TYPE_DECIMAL, 'comment' => 'UnitPrice']);
        	}
        	if ($connection->tableColumnExists($table_name, 'UnitVolume' ) === false) {
        		$connection->addColumn($table_name, 'UnitVolume', ['length' => '20,4','default' => null,'type' => Table::TYPE_DECIMAL, 'comment' => 'UnitVolume']);
        	} else {
        		$connection->modifyColumn($table_name, 'UnitVolume', ['length' => '20,4','default' => null,'type' => Table::TYPE_DECIMAL, 'comment' => 'UnitVolume']);
        	}
        	if ($connection->tableColumnExists($table_name, 'UnitsPerParcel' ) === false) {
        		$connection->addColumn($table_name, 'UnitsPerParcel', ['length' => '20,4','default' => null,'type' => Table::TYPE_DECIMAL, 'comment' => 'UnitsPerParcel']);
        	} else {
        		$connection->modifyColumn($table_name, 'UnitsPerParcel', ['length' => '20,4','default' => null,'type' => Table::TYPE_DECIMAL, 'comment' => 'UnitsPerParcel']);
        	}
        	if ($connection->tableColumnExists($table_name, 'VendorId' ) === false) {
        		$connection->addColumn($table_name, 'VendorId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'VendorId']);
        	} else {
        		$connection->modifyColumn($table_name, 'VendorId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'VendorId']);
        	}
        	if ($connection->tableColumnExists($table_name, 'VendorItemId' ) === false) {
        		$connection->addColumn($table_name, 'VendorItemId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'VendorItemId']);
        	} else {
        		$connection->modifyColumn($table_name, 'VendorItemId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'VendorItemId']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ZeroPriceValId' ) === false) {
        		$connection->addColumn($table_name, 'ZeroPriceValId', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'ZeroPriceValId']);
        	} else {
        		$connection->modifyColumn($table_name, 'ZeroPriceValId', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'ZeroPriceValId']);
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

