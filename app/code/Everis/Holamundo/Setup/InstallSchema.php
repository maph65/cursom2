<?php

namespace Everis\Holamundo\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $newTable =  $setup->getTable('everis_holamundo');

        if(!$setup->tableExists($setup->getTable($newTable))){
            $table = $setup->getConnection()->newTable(
                $newTable
            )->addColumn('entity_id',Table::TYPE_INTEGER,10,
                array('primary'=>true,'nullable'=>false,'identity'=>true))
                ->addColumn('value',Table::TYPE_TEXT, 255,
                    array('nullable'=>false));

            $setup->getConnection()->createTable($table);
        }
        $setup->endSetup();
        //die('fin de ejecución');
    }

}
