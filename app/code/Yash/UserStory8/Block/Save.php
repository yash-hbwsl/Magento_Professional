<?php

namespace Yash\UserStory8\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Save extends Template
{

    public function __construct(
        Context $context,
    ) {
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Employee Form Page '));
        return parent::_prepareLayout();
    }

    public function getFormAction()
    {
        return $this->getUrl('save/index/save');
    }
}
