<?php

namespace Everis\Direccion\Plugins\Checkout;

use Magento\Checkout\Model\ShippingInformationManagement;

use Magento\Quote\Model\QuoteRepository;
use \Zend\Log\Logger;
//use Psr\Log\LoggerInterface as Logger;

class ShippingSetData{

    protected $quoteRepository;

    protected $logger;

    public function __construct(
        QuoteRepository $quoteRepository,
        Logger $logger
    )
    {
        $this->quoteRepository = $quoteRepository;
        $this->logger = $logger;
        $writer = new \Zend\Log\Writer\Stream(BP.'/var/log/ShippingSetData.log');
        $this->logger->addWriter($writer);
    }

    protected function log($message){
        $this->logger->info($message);
    }

    public function beforeSaveAddressInformation(
        ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    ) {
        if($addressInformation){
            try{
                $shippingAddress = $addressInformation->getShippingAddress();
                $billingAddress = $addressInformation->getBillingAddress();
                $extAttributtes = $billingAddress->getExtensionAttributes();

                $billingAddress->setNumInt($extAttributtes->getNumInt());
                $billingAddress->setNumExt($extAttributtes->getNumExt());
                $billingAddress->setNeighborhood($extAttributtes->getNeighborhood());

                if(!$shippingAddress->getSameAsBilling()){
                    $extAttributtes = $billingAddress->getExtensionAttributes();
                }
                $shippingAddress->setNumInt($extAttributtes->getNumInt());
                $shippingAddress->setNumExt($extAttributtes->getNumExt());
                $shippingAddress->setNeighborhood($extAttributtes->getNeighborhood());

                $this->log('Shipping Address:');
                $this->log(print_r($billingAddress->getData(),true));

                $this->log('Billing Address:');
                $this->log(print_r($shippingAddress->getData(),true));

                $quote = $this->quoteRepository->getActive($cartId);

                $quote->getShippingAddress()->setData($shippingAddress->getData())->save();
                $quote->getBillingAddress()->setData($billingAddress->getData())->save();


            }catch(\Exception $e){
                throw new \Exception('Error en Address ShippingSetData '. $e->getMessage());
            }

        }
    }

}
