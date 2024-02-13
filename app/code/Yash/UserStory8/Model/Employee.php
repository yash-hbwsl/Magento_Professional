<?php

namespace Yash\UserStory8\Model;

use Magento\Framework\Model\AbstractModel;

class Employee extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Yash\UserStory8\Model\ResourceModel\Employee'::class);
    }
}
