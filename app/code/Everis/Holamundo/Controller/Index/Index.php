<?php

namespace Everis\Holamundo\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action {

    protected $_request;

    protected $_pageFactory;

    public function __construct(
        Context $context,
        RequestInterface $request,
        PageFactory $pageFactory
    ){
        $this->_request = $request;
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute(){
        return $this->_pageFactory->create();
    }

}
