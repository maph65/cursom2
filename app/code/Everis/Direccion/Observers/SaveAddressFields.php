<?php

namespace Everis\Direccion\Observers;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

use \Zend\Log\Writer\Stream as LoggerStream;
use \Zend\Log\Logger;

class SaveAddressFields implements ObserverInterface{

    protected $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
        $writer = new LoggerStream(BP.'/var/log/observerSaveAddressField.log');
        $this->logger->addWriter($writer);
    }

    protected function getLogger(){
        return $this->logger;
    }

    public function log($message){
        $this->getLogger()->info($message);
    }

    public function execute(Observer $observer)
    {
        /* @var $quote Magento\Sales\Model\Quote */
        $quote = $observer->getQuote();
        /* @var $quote Magento\Sales\Model\Order */
        $order = $observer->getOrder();

        $shippingAddress = $quote->getShippingAddress();

        $numInt = $shippingAddress->getNumInt();
        $numExt = $shippingAddress->getNumExt();
        $neighborhood = $shippingAddress->getNeighborhood();

        $orderSA = $order->getShippingAddress();
        $orderSA->setNumInt($numInt);
        $orderSA->setNumExt($numExt);
        $orderSA->setNeighborhood($neighborhood);
        $orderSA->save();


        if($shippingAddress->getSameAsBilling()){
            $orderBA = $order->getBillingAddress();
            $orderBA->setNumInt($numInt);
            $orderBA->setNumExt($numExt);
            $orderBA->setNeighborhood($neighborhood);
            $orderBA->save();
        }else{
            $billingAddress = $quote->getBillingAddress();
            $numInt = $billingAddress->getNumInt();
            $numExt = $billingAddress->getNumExt();
            $neighborhood = $billingAddress->getNeighborhood();
            $orderBA = $order->getBillingAddress();
            $orderBA->setNumInt($numInt);
            $orderBA->setNumExt($numExt);
            $orderBA->setNeighborhood($neighborhood);
            $orderBA->save();
        }

    }

}
