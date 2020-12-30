<?php

namespace Everis\Holamundo\Model;

use Magento\Framework\Model\AbstractModel;

class Holamundo extends AbstractModel {

    public function _construct()
    {
        $this->_init(
            'Everis\Holamundo\Model\Resource\Holamundo'
        );
    }

}
