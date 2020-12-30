<?php

namespace Everis\Direccion\Controller\Direccion;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use \Magento\Framework\App\Action\Action;
use Everis\Direccion\Model\Resource\Neighborhood\CollectionFactory as NeighborhoodCollectionFactory;
use Magento\Framework\Controller\Result\JsonFactory;

class Get extends Action {

    protected $_request;
    protected $_neighborhoodCollectionFactory;
    protected $_jsonFactory;

    public function __construct(
        RequestInterface $_request,
        NeighborhoodCollectionFactory $_neighborhoodCollectionFactory,
        JsonFactory $_jsonFactory,
        Context $context
    ){
        $this->_request = $_request;
        $this->_neighborhoodCollectionFactory = $_neighborhoodCollectionFactory;
        $this->_jsonFactory = $_jsonFactory;
        parent::__construct($context);
    }

    public function execute(){
        $result = array(
            'result' => 'ok'
        );
        try{

        }catch(\Exception $e){
            $result = array(
                'result' => 'error'
            );
        }
        $output = $this->_jsonFactory->create();
        return $output->setData($result);
    }

}
