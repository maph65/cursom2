<?php

namespace Everis\Holamundo\Helper;

use Everis\Holamundo\Model\Resource\Holamundo\CollectionFactory as HolamundoCollectionFactory;
use Everis\Holamundo\Model\HolamundoFactory;
use Magento\Framework\App\Helper\AbstractHelper;

class HolamundoHelper extends AbstractHelper {

    protected $_holamundoCollectionFactory;
    protected $_holamundoFactory;

    public function __construct(
        HolamundoCollectionFactory $_holamundoCollectionFactory,
        HolamundoFactory $_holamundoFactory
    ){
        $this->_holamundoCollectionFactory = $_holamundoCollectionFactory;
        $this->_holamundoFactory = $_holamundoFactory;

    }

    public function updateHolamundo($option,$value, $id = ''){
        $holamundo = $this->_holamundoFactory->create();
        //var_dump($holamundo);
        //die();
        $holamundo->setData(
            array('value' => $value,
                'option' => $option)
        );
        $holamundo->save();
    }


}
