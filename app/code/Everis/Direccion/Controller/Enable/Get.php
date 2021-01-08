<?php

namespace Everis\Direccion\Controller\Enable;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use \Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\Result\JsonFactory;
use Everis\Direccion\Helper\Config;

class Get extends Action {

    protected $_request;
    protected $_jsonFactory;
    protected $_config;

    public function __construct(
        RequestInterface $_request,
        JsonFactory $_jsonFactory,
        Config $config,
        Context $context
    ){
        $this->_request = $_request;
        $this->_jsonFactory = $_jsonFactory;
        $this->_config = $config;
        parent::__construct($context);
    }

    public function execute(){
        $result = array(
            'is_enable' => $this->_config->getIsModuleEnable()
        );
        $output = $this->_jsonFactory->create();
        return $output->setData($result);
    }
}
