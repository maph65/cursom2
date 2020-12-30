<?php

namespace Everis\Direccion\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

use Magento\Eav\Model\Config;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;

class InstallData implements InstallDataInterface{

    protected $_customerSetupFactory;
    protected $_eavConfig;
    protected $_attributeSetFactory;

    public function __construct(
        Config $_eavConfig,
        CustomerSetupFactory $_customerSetupFactory,
        AttributeSetFactory $_attributeSetFactory
    ){
        $this->_eavConfig = $_eavConfig;
        $this->_customerSetupFactory = $_customerSetupFactory;
        $this->_attributeSetFactory = $_attributeSetFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $customerSetup = $this->_customerSetupFactory->create(['setup' => $setup ]);
        $customerEntity = $customerSetup->getEavConfig()->getEntityType('customer_address');
        $attributeSetId = $customerEntity->getDefaultAttributeSetId();

        $attributeSet = $this->_attributeSetFactory->create();
        $attributeSetGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

        $customerSetup->addAttribute(
            'customer_address',
            'neighborhood',
            array(
                'type' => 'varchar',
                'input' => 'text',
                'label' => 'Neighborhood',
                'global' => 1,
                'visible' => 1,
                'required' => 0,
                'user_defined' => 1,
                'visible_on_front' => 1,
                'sort_order' => 710,
                'position' => 710
            )
        );
        $neigborhoodAttribute = $customerSetup->getEavConfig()->getAttribute('customer_address','neighborhood');
        $neigborhoodAttribute->setData('attribute_set_id',$attributeSetId);
        $neigborhoodAttribute->setData('attribute_group_id',$attributeSetGroupId);
        $neigborhoodAttribute->setData(
            'used_in_forms', ['adminhtml_customer_address','customer_address_edit','customer_register_address']
        );
        $neigborhoodAttribute->save();

        $customerSetup->addAttribute(
            'customer_address',
            'num_ext',
            array(
                'type' => 'varchar',
                'input' => 'text',
                'label' => 'External Number',
                'global' => 1,
                'visible' => 1,
                'required' => 1,
                'user_defined' => 1,
                'visible_on_front' => 1,
                'sort_order' => 410,
                'position' => 410
            )
        );
        $numExtAttribute = $customerSetup->getEavConfig()->getAttribute('customer_address','num_ext');
        $numExtAttribute->setData('attribute_set_id',$attributeSetId);
        $numExtAttribute->setData('attribute_group_id',$attributeSetGroupId);
        $numExtAttribute->setData(
            'used_in_forms', ['adminhtml_customer_address','customer_address_edit','customer_register_address']
        );
        $numExtAttribute->save();

        $customerSetup->addAttribute(
            'customer_address',
            'num_int',
            array(
                'type' => 'varchar',
                'input' => 'text',
                'label' => 'Internal Number',
                'global' => 1,
                'visible' => 1,
                'required' => 0,
                'user_defined' => 1,
                'visible_on_front' => 1,
                'sort_order' => 420,
                'position' => 420
            )
        );
        $numIntAttribute = $customerSetup->getEavConfig()->getAttribute('customer_address','num_int');
        $numIntAttribute->setData('attribute_set_id',$attributeSetId);
        $numIntAttribute->setData('attribute_group_id',$attributeSetGroupId);
        $numIntAttribute->setData(
            'used_in_forms', ['adminhtml_customer_address','customer_address_edit','customer_register_address']
        );
        $numIntAttribute->save();



        $setup->endSetup();
    }

}
