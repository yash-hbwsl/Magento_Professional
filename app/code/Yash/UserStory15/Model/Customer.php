<?php

namespace Yash\UserStory15\Model;

use Magento\Framework\Model\AbstractModel;

class Customer extends AbstractModel
{

    protected function _construct()
    {
        $this->_init('Yash\UserStory15\Model\ResourceModel\Customer'::class);
    }
}
