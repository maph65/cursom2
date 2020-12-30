<?php

namespace Everis\Holamundo\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if(version_compare($context->getVersion(),'0.0.2','<')){
            $setup->startSetup();

            $table =  $setup->getTable('everis_holamundo');

            $setup->getConnection()->addColumn(
                $table,'option',
                array(
                    'type' => Table::TYPE_TEXT,
                    'length' => 255,
                    'nullable' => false,
                    'comment' => 'Columa opcion'
                )
            );

            $setup->endSetup();
        }


        if(version_compare($context->getVersion(),'0.1.0','<')){
            $setup->startSetup();
           // TODo: Codigo version 0.1.0
            $setup->endSetup();
        }


    }

}

