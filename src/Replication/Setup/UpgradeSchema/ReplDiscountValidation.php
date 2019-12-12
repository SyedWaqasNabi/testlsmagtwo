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

class ReplDiscountValidation
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $table_name = $setup->getTable( 'ls_replication_repl_discount_validation' ); 
        if(!$setup->tableExists($table_name)) {
        	$table = $setup->getConnection()->newTable( $table_name );
        	$table->addColumn('repl_discount_validation_id', Table::TYPE_INTEGER, 11, [ 'identity' => TRUE, 'primary' => TRUE, 'unsigned' => TRUE, 'nullable' => FALSE, 'auto_increment'=> TRUE ]);
        	$table->addColumn('scope', Table::TYPE_TEXT, 8);
        	$table->addColumn('scope_id', Table::TYPE_INTEGER, 11);
        	$table->addColumn('processed', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already copied into Magento. 0 means needs to be copied into Magento tables & 1 means already copied');
        	$table->addColumn('is_updated', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already updated from Omni into Magento. 0 means already updated & 1 means needs to be updated into Magento tables');
        	$table->addColumn('is_failed', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already added from Flat into Magento successfully or not. 0 means already added successfully & 1 means failed to add successfully into Magento tables');
        	$table->addColumn('Description' , Table::TYPE_TEXT, '');
        	$table->addColumn('EndAfterMidnight' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('EndDate' , Table::TYPE_TEXT, '');
        	$table->addColumn('EndTime' , Table::TYPE_TEXT, '');
        	$table->addColumn('FridayEnd' , Table::TYPE_TEXT, '');
        	$table->addColumn('FridayEndAfterMidnight' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('FridayStart' , Table::TYPE_TEXT, '');
        	$table->addColumn('FridayWithinBounds' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('nav_id' , Table::TYPE_TEXT, '');
        	$table->addColumn('IsDeleted' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('MondayEnd' , Table::TYPE_TEXT, '');
        	$table->addColumn('MondayEndAfterMidnight' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('MondayStart' , Table::TYPE_TEXT, '');
        	$table->addColumn('MondayWithinBounds' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('SaturdayEnd' , Table::TYPE_TEXT, '');
        	$table->addColumn('SaturdayEndAfterMidnight' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('SaturdayStart' , Table::TYPE_TEXT, '');
        	$table->addColumn('SaturdayWithinBounds' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('StartDate' , Table::TYPE_TEXT, '');
        	$table->addColumn('StartTime' , Table::TYPE_TEXT, '');
        	$table->addColumn('SundayEnd' , Table::TYPE_TEXT, '');
        	$table->addColumn('SundayEndAfterMidnight' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('SundayStart' , Table::TYPE_TEXT, '');
        	$table->addColumn('SundayWithinBounds' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('ThursdayEnd' , Table::TYPE_TEXT, '');
        	$table->addColumn('ThursdayEndAfterMidnight' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('ThursdayStart' , Table::TYPE_TEXT, '');
        	$table->addColumn('ThursdayWithinBounds' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('TimeWithinBounds' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('TuesdayEnd' , Table::TYPE_TEXT, '');
        	$table->addColumn('TuesdayEndAfterMidnight' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('TuesdayStart' , Table::TYPE_TEXT, '');
        	$table->addColumn('TuesdayWithinBounds' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('WednesdayEnd' , Table::TYPE_TEXT, '');
        	$table->addColumn('WednesdayEndAfterMidnight' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('WednesdayStart' , Table::TYPE_TEXT, '');
        	$table->addColumn('WednesdayWithinBounds' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('created_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT ], 'Created At');
        	$table->addColumn('updated_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE ], 'Updated At');
        	$setup->getConnection()->createTable( $table );
        } else {
        	$connection = $setup->getConnection();
        	if ($connection->tableColumnExists($table_name, 'Description' ) === false) {
        		$connection->addColumn($table_name, 'Description', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Description']);
        	}
        	if ($connection->tableColumnExists($table_name, 'EndAfterMidnight' ) === false) {
        		$connection->addColumn($table_name, 'EndAfterMidnight', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'EndAfterMidnight']);
        	}
        	if ($connection->tableColumnExists($table_name, 'EndDate' ) === false) {
        		$connection->addColumn($table_name, 'EndDate', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'EndDate']);
        	}
        	if ($connection->tableColumnExists($table_name, 'EndTime' ) === false) {
        		$connection->addColumn($table_name, 'EndTime', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'EndTime']);
        	}
        	if ($connection->tableColumnExists($table_name, 'FridayEnd' ) === false) {
        		$connection->addColumn($table_name, 'FridayEnd', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'FridayEnd']);
        	}
        	if ($connection->tableColumnExists($table_name, 'FridayEndAfterMidnight' ) === false) {
        		$connection->addColumn($table_name, 'FridayEndAfterMidnight', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'FridayEndAfterMidnight']);
        	}
        	if ($connection->tableColumnExists($table_name, 'FridayStart' ) === false) {
        		$connection->addColumn($table_name, 'FridayStart', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'FridayStart']);
        	}
        	if ($connection->tableColumnExists($table_name, 'FridayWithinBounds' ) === false) {
        		$connection->addColumn($table_name, 'FridayWithinBounds', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'FridayWithinBounds']);
        	}
        	if ($connection->tableColumnExists($table_name, 'nav_id' ) === false) {
        		$connection->addColumn($table_name, 'nav_id', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Nav_id']);
        	}
        	if ($connection->tableColumnExists($table_name, 'IsDeleted' ) === false) {
        		$connection->addColumn($table_name, 'IsDeleted', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'IsDeleted']);
        	}
        	if ($connection->tableColumnExists($table_name, 'MondayEnd' ) === false) {
        		$connection->addColumn($table_name, 'MondayEnd', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'MondayEnd']);
        	}
        	if ($connection->tableColumnExists($table_name, 'MondayEndAfterMidnight' ) === false) {
        		$connection->addColumn($table_name, 'MondayEndAfterMidnight', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'MondayEndAfterMidnight']);
        	}
        	if ($connection->tableColumnExists($table_name, 'MondayStart' ) === false) {
        		$connection->addColumn($table_name, 'MondayStart', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'MondayStart']);
        	}
        	if ($connection->tableColumnExists($table_name, 'MondayWithinBounds' ) === false) {
        		$connection->addColumn($table_name, 'MondayWithinBounds', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'MondayWithinBounds']);
        	}
        	if ($connection->tableColumnExists($table_name, 'SaturdayEnd' ) === false) {
        		$connection->addColumn($table_name, 'SaturdayEnd', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'SaturdayEnd']);
        	}
        	if ($connection->tableColumnExists($table_name, 'SaturdayEndAfterMidnight' ) === false) {
        		$connection->addColumn($table_name, 'SaturdayEndAfterMidnight', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'SaturdayEndAfterMidnight']);
        	}
        	if ($connection->tableColumnExists($table_name, 'SaturdayStart' ) === false) {
        		$connection->addColumn($table_name, 'SaturdayStart', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'SaturdayStart']);
        	}
        	if ($connection->tableColumnExists($table_name, 'SaturdayWithinBounds' ) === false) {
        		$connection->addColumn($table_name, 'SaturdayWithinBounds', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'SaturdayWithinBounds']);
        	}
        	if ($connection->tableColumnExists($table_name, 'StartDate' ) === false) {
        		$connection->addColumn($table_name, 'StartDate', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'StartDate']);
        	}
        	if ($connection->tableColumnExists($table_name, 'StartTime' ) === false) {
        		$connection->addColumn($table_name, 'StartTime', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'StartTime']);
        	}
        	if ($connection->tableColumnExists($table_name, 'SundayEnd' ) === false) {
        		$connection->addColumn($table_name, 'SundayEnd', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'SundayEnd']);
        	}
        	if ($connection->tableColumnExists($table_name, 'SundayEndAfterMidnight' ) === false) {
        		$connection->addColumn($table_name, 'SundayEndAfterMidnight', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'SundayEndAfterMidnight']);
        	}
        	if ($connection->tableColumnExists($table_name, 'SundayStart' ) === false) {
        		$connection->addColumn($table_name, 'SundayStart', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'SundayStart']);
        	}
        	if ($connection->tableColumnExists($table_name, 'SundayWithinBounds' ) === false) {
        		$connection->addColumn($table_name, 'SundayWithinBounds', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'SundayWithinBounds']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ThursdayEnd' ) === false) {
        		$connection->addColumn($table_name, 'ThursdayEnd', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'ThursdayEnd']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ThursdayEndAfterMidnight' ) === false) {
        		$connection->addColumn($table_name, 'ThursdayEndAfterMidnight', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'ThursdayEndAfterMidnight']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ThursdayStart' ) === false) {
        		$connection->addColumn($table_name, 'ThursdayStart', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'ThursdayStart']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ThursdayWithinBounds' ) === false) {
        		$connection->addColumn($table_name, 'ThursdayWithinBounds', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'ThursdayWithinBounds']);
        	}
        	if ($connection->tableColumnExists($table_name, 'TimeWithinBounds' ) === false) {
        		$connection->addColumn($table_name, 'TimeWithinBounds', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'TimeWithinBounds']);
        	}
        	if ($connection->tableColumnExists($table_name, 'TuesdayEnd' ) === false) {
        		$connection->addColumn($table_name, 'TuesdayEnd', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'TuesdayEnd']);
        	}
        	if ($connection->tableColumnExists($table_name, 'TuesdayEndAfterMidnight' ) === false) {
        		$connection->addColumn($table_name, 'TuesdayEndAfterMidnight', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'TuesdayEndAfterMidnight']);
        	}
        	if ($connection->tableColumnExists($table_name, 'TuesdayStart' ) === false) {
        		$connection->addColumn($table_name, 'TuesdayStart', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'TuesdayStart']);
        	}
        	if ($connection->tableColumnExists($table_name, 'TuesdayWithinBounds' ) === false) {
        		$connection->addColumn($table_name, 'TuesdayWithinBounds', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'TuesdayWithinBounds']);
        	}
        	if ($connection->tableColumnExists($table_name, 'WednesdayEnd' ) === false) {
        		$connection->addColumn($table_name, 'WednesdayEnd', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'WednesdayEnd']);
        	}
        	if ($connection->tableColumnExists($table_name, 'WednesdayEndAfterMidnight' ) === false) {
        		$connection->addColumn($table_name, 'WednesdayEndAfterMidnight', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'WednesdayEndAfterMidnight']);
        	}
        	if ($connection->tableColumnExists($table_name, 'WednesdayStart' ) === false) {
        		$connection->addColumn($table_name, 'WednesdayStart', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'WednesdayStart']);
        	}
        	if ($connection->tableColumnExists($table_name, 'WednesdayWithinBounds' ) === false) {
        		$connection->addColumn($table_name, 'WednesdayWithinBounds', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'WednesdayWithinBounds']);
        	}
        	if ($connection->tableColumnExists($table_name, 'is_failed' ) === false) {
        		$connection->addColumn($table_name, 'is_failed', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'Is_failed']);
        	}
        }
    }


}

