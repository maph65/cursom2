<?php

namespace Everis\Direccion\Plugins\Quote;

use Magento\Quote\Api\Data\AddressInterface;
use Magento\Quote\Api\Data\CartInterface;

class AddressPersister{

    public function beforeSave(
        Magento\Quote\Model\Quote\Address\BillingAddressPersister $subject,
        CartInterface $quote,
        AddressInterface $address,
        $useForShipping = false){

        $extAttributes = $address->getExtensionAttributes();
        if(!empty($extAttributes)){
            try{
                $address->setNumInt($extAttributes->getNumInt());
                $address->setNumExt($extAttributes->getNumExt());
                $address->setNeighborhood($extAttributes->getNeighborhood());
            }catch(\Exception $e){
                //TODO: Add expection messsage
                throw new \Exception('Error en Address Persister. '.$e->getMessage());
            }
        }
    }

}
