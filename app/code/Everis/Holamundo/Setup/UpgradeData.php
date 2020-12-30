<?php

namespace Everis\Holamundo\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;

class UpgradeData implements UpgradeDataInterface {

    protected $_customerSetupFactory;
    protected $_attributeSetFactory;

    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        AttributeSetFactory $attributeSetFactory
    ){
        $this->_customerSetupFactory = $customerSetupFactory;
        $this->_attributeSetFactory = $attributeSetFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

        if(version_compare($context->getVersion(),'0.0.3','<')) {
            $setup->startSetup();

            $data = [
                array('value' => 'value01', 'option' => 'option01'),
                array('value' => 'value02', 'option' => 'option02'),
            ];

            $table = $setup->getTable('everis_holamundo');

            $setup->getConnection()->insertMultiple($table, $data);

            $setup->endSetup();
        }



        if(version_compare($context->getVersion(),'0.1.0','<')) {
            $setup->startSetup();
            $customerSetup = $this->_customerSetupFactory->create(['setup' => $setup ]);
            $customerEntity = $customerSetup->getEavConfig()->getEntityType('customer');
            $attributeSetId = $customerEntity->getDefaultAttributeSetId();

            $attributeSet = $this->_attributeSetFactory->create();
            $attributeSetGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

            $customerSetup->addAttribute(
                'customer',
                'genero',
                array(
                    'type' => 'varchar',
                    'input' => 'text',
                    'label' => 'Genero',
                    'global' => 1,
                    'visible' => 1,
                    'required' => 0,
                    'user_defined' => 1
                )
            );
            $customerAttribute = $customerSetup->getEavConfig()->getAttribute('customer','genero');
            $customerAttribute->setData('attribute_set_id',$attributeSetId);
            $customerAttribute->setData('attribute_group_id',$attributeSetGroupId);
            $customerAttribute->setData(
                'used_in_forms', ['adminhtml_customer','customer_edit','customer_register']
            );
            $customerAttribute->save();
            $setup->endSetup();

        }
    }

}
