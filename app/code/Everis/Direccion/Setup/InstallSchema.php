<?php

namespace Everis\Direccion\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $newTable =  $setup->getTable('directory_country_neighborhood');

        if(!$setup->tableExists($setup->getTable($newTable))){
            $table = $setup->getConnection()->newTable(
                $newTable
            )->addColumn('entity_id',Table::TYPE_INTEGER,10,
                array('primary'=>true,'nullable'=>false,'identity'=>true))
                ->addColumn('name',Table::TYPE_TEXT, 255,
                    array('nullable'=>false))
                ->addColumn('zipcode',Table::TYPE_TEXT, 10,
                    array('nullable'=>false)
                )->addColumn('country_id',Table::TYPE_TEXT, 2,
                    array('nullable'=>false)
                );
            $setup->getConnection()->createTable($table);
        }
        $setup->endSetup();
    }

}
