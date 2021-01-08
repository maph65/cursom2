<?php

namespace Everis\Holamundo\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\PageFactory;

use Magento\Framework\Event\ManagerInterface as EventManager;

class Index extends \Magento\Framework\App\Action\Action {

    protected $_request;

    protected $_pageFactory;

    protected $_eventManager;

    public function __construct(
        Context $context,
        RequestInterface $request,
        PageFactory $pageFactory,
        EventManager $_eventManager
    ){
        $this->_request = $request;
        $this->_pageFactory = $pageFactory;
        $this->_eventManager = $_eventManager;
        parent::__construct($context);
    }

    public function execute(){

        $this->eventManager->dispatch(
            'holamundo_before_execute_controller',
            [
                'request' => $this->_request,
            ]
        );

        return $this->_pageFactory->create();
    }

}
