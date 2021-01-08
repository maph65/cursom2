<?php

namespace Everis\Direccion\Controller\Direccion;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use \Magento\Framework\App\Action\Action;
use Everis\Direccion\Model\NeighborhoodFactory as NeighborhoodFactory;
use Magento\Framework\Controller\Result\JsonFactory;

class Get extends Action {

    protected $_request;
    protected $_neighborhoodFactory;
    protected $_jsonFactory;

    public function __construct(
        RequestInterface $_request,
        NeighborhoodFactory $_neighborhoodFactory,
        JsonFactory $_jsonFactory,
        Context $context
    ){
        $this->_request = $_request;
        $this->_neighborhoodFactory = $_neighborhoodFactory;
        $this->_jsonFactory = $_jsonFactory;
        parent::__construct($context);
    }

    public function execute(){
        $result = array(
            'result' => 'ok',
            'count' => 0,
            'neighborhood' => array()
        );
        $zipcode = $this->_request->getParam('zipcode');
        $countryId = $this->_request->getParam('country');
        try{
            $neighborhood = $this->_neighborhoodFactory->create();
            if(!empty($zipcode) && !empty($countryId)){
                $collection = $neighborhood->getCollection()
                    ->addFieldToFilter('zipcode',$zipcode)
                    ->addFieldToFilter('country_id',$countryId);
                $count = count($collection);
                if($count){
                    $result['count'] = $count;
                    foreach ($collection as $_n){
                        $result['neighborhood'][] = $_n->getData();
                    }
                }
            }
        }catch(\Exception $e){
            $result = array(
                'result' => 'error'
            );
        }
        $output = $this->_jsonFactory->create();
        return $output->setData($result);
    }
}
