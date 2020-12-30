<?php

namespace Everis\Holamundo\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface{

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $data = [
            array('value'=>'value01','option'=> 'option01' ),
            array('value'=>'value02','option'=> 'option02' ),
        ];

        $table =  $setup->getTable('everis_holamundo');

        $setup->getConnection()->insertMultiple($table,$data);

        $setup->endSetup();
    }

}
