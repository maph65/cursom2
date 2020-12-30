<?php

namespace Everis\Direccion\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

use Everis\Direccion\Model\NeighborhoodFactory;
use Everis\Direccion\Model\Resource\Neighborhood as NeighborhoodResource;

class UpgradeData implements UpgradeDataInterface {

    protected $_neighborhoodFactory;
    protected $_neighborhoodResource;

    public function __construct(
        NeighborhoodFactory $_neighborhoodFactory,
        NeighborhoodResource $_neighborhoodResource
    ){
        $this->_neighborhoodFactory = $_neighborhoodFactory;
        $this->_neighborhoodResource = $_neighborhoodResource;
    }


    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

        if (version_compare($context->getVersion(), '0.0.2', '<')) {
            $setup->startSetup();

            $countryId = 'MX';

            $array = array(
                array('name' => 'Barrio 1', 'zipcode' => '10000','country_id' => $countryId),
                array('name' => 'Barrio 2', 'zipcode' => '15000','country_id' => $countryId),
                array('name' => 'Barrio 3', 'zipcode' => '20000','country_id' => $countryId),
                array('name' => 'Barrio 4', 'zipcode' => '23000','country_id' => $countryId)
            );

            foreach ($array as $record){
                $neighborhood = $this->_neighborhoodFactory->create();
                $neighborhood->setData($record);

                /*$neigborhood->setName($record['name']);
                $neigborhood->setAny('sdfsdf');
                $neigborhood->setZipcode($record['zipcode']);
                $neigborhood->setCountryId($record['country_id']);*/

                /* Para Magento 2.2 o anterior */
                //$neigborhood->save();

                /* Para Magento 2.3 o superior */
                $this->_neighborhoodResource->save($neighborhood);

            }

            $setup->endSetup();
        }
    }

}
