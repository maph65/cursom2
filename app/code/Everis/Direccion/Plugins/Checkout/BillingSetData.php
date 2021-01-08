<?php

namespace Everis\Direccion\Plugins\Checkout;

use Magento\Checkout\Model\PaymentInformationManagement;

class BillingSetData{

    public function beforeSavePaymentInformationAndPlaceOrder(
        PaymentInformationManagement $subject,
        $cartId,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod,
        \Magento\Quote\Api\Data\AddressInterface $billingAddress = null
    ){
        if($billingAddress){
            $extAttributtes = $billingAddress->getExtensionAttributes();
            try{
                $billingAddress->setNumInt($extAttributtes->getNumInt());
                $billingAddress->setNumExt($extAttributtes->getNumExt());
                $billingAddress->setNeighborhood($extAttributtes->getNeighborhood());
            }catch(\Exception $e){
                //TODO: Excepcion
                throw new \Exception('Error en BillingSetData. '.$e->getMessage());
            }

        }
    }

}
