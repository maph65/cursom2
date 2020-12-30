<?php

namespace Everis\Holamundo\Block;

use Magento\Framework\View\Element\Template;
use Everis\Holamundo\Model\HolamundoFactory;
use Everis\Holamundo\Model\Resource\Holamundo as HolamundoResource;
use Everis\Holamundo\Model\Resource\Holamundo\CollectionFactory as HolamundoCollectionFactory;
use Everis\Holamundo\Helper\HolamundoHelper;

class Demo extends Template{

    protected $_holamundoFactory;

    protected $_holamundoResource;

    protected $_holamundoCollectionFactory;

    protected $_holamundoHelper;

    public function __construct(
        HolamundoHelper $_holamundoHelper,
        HolamundoResource $_holamundoResource,
        HolamundoCollectionFactory $_holamundoCollectionFactory,
        HolamundoFactory $_holamundoFactory,
        Template\Context $context,
        array $data = [])
    {
        $this->_holamundoHelper = $_holamundoHelper;
        $this->_holamundoResource = $_holamundoResource;
        $this->_holamundoCollectionFactory = $_holamundoCollectionFactory;
        $this->_holamundoFactory = $_holamundoFactory;
        parent::__construct($context, $data);
    }

    public function getHolamundo(){
        $holamundo = $this->_holamundoFactory->create();
        $this->_holamundoResource->load($holamundo,1);

        $holamundo->setValue('value1');
        $holamundo->setOption('option1');

        $this->_holamundoResource->save($holamundo);

        return $holamundo;
    }

    /*public function getHolamundoCollection(){
        $collection = $this->_holamundoCollectionFactory->create()->load();
        if(!empty($collection)){
            foreach ($collection as $object){
                try{
                    $object->setValue('nuevo value');
                    $object->setOption('nuevo option');
                    $object->save();
                }catch(\Exception $e){
                    echo $e->getMessage();
                }
            }
        }
        return $this->_holamundoHelper->updateHolamundo('option3','value3');
    }*/
}
