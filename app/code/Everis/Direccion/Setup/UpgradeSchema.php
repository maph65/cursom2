<?php

namespace Everis\Direccion\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;


class UpgradeSchema implements UpgradeSchemaInterface{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '0.0.3', '<')) {
            $setup->startSetup();

            $table = $setup->getTable('quote_address');

            $setup->getConnection()->addColumn(
                $table,
                'neighborhood',
                array(
                    'type' => Table::TYPE_TEXT,
                    'length' => 100,
                    'nullable' => true,
                    'comment' => 'Column Neighborhood'
                )
            );

            $setup->getConnection()->addColumn(
                $table,
                'num_ext',
                array(
                    'type' => Table::TYPE_TEXT,
                    'length' => 20,
                    'nullable' => false,
                    'comment' => 'Número Exterior'
                )
            );

            $setup->getConnection()->addColumn(
                $table,
                'num_int',
                array(
                    'type' => Table::TYPE_TEXT,
                    'length' => 20,
                    'nullable' => true,
                    'comment' => 'Número Interior'
                )
            );

            $table = $setup->getTable('sales_order_address');

            $setup->getConnection()->addColumn(
                $table,
                'neighborhood',
                array(
                    'type' => Table::TYPE_TEXT,
                    'length' => 100,
                    'nullable' => true,
                    'comment' => 'Column Neighborhood'
                )
            );

            $setup->getConnection()->addColumn(
                $table,
                'num_ext',
                array(
                    'type' => Table::TYPE_TEXT,
                    'length' => 20,
                    'nullable' => false,
                    'comment' => 'Número Exterior'
                )
            );

            $setup->getConnection()->addColumn(
                $table,
                'num_int',
                array(
                    'type' => Table::TYPE_TEXT,
                    'length' => 20,
                    'nullable' => true,
                    'comment' => 'Número Interior'
                )
            );

            $setup->endSetup();
        }
    }

}
