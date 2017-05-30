<?php

namespace Ls\Replication\Setup\UpgradeSchema;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class UnitOfMeasure implements UpgradeSchemaBlockInterface
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if ( ! $setup->tableExists( 'lsr_replication_unit_of_measure' ) ) {

        	$table = new Table();
        	$table->setName( 'lsr_replication_unit_of_measure' ); 

        	$table->addColumn( 'unit_of_measure_id', Table::TYPE_INTEGER, NULL, 
        	                    [ 'identity' => TRUE, 'unsigned' => TRUE, 'nullable' => FALSE, 'auto_increment' => TRUE ] );
        	$table->addColumn( 'Del' , Table::TYPE_BOOLEAN );
        	$table->addColumn( 'Description' , Table::TYPE_BLOB );
        	$table->addColumn( 'Id' , Table::TYPE_BLOB );
        	$table->addColumn( 'ShortDescription' , Table::TYPE_BLOB );
        	$table->addColumn( 'UnitDecimals' , Table::TYPE_INTEGER );
        	$table->addColumn( 'scope', Table::TYPE_TEXT, 8);
        	$table->addColumn( 'scope_id', Table::TYPE_INTEGER, 11);
        	$table->addColumn( 'processed', Table::TYPE_BOOLEAN, null, [ 'default' => FALSE ] );

        	$setup->getConnection()->createTable( $table );
        }
    }


}
