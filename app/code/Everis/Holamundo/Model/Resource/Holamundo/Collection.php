<?php

namespace Everis\Holamundo\Model\Resource\Holamundo;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection{

    public function _construct(){
        $this->_init(
            'Everis\Holamundo\Model\Holamundo',
            'Everis\Holamundo\Model\Resource\Holamundo'
        );
    }
}
