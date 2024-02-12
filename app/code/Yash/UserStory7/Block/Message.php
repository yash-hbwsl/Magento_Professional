<?php

namespace Yash\UserStory7\Block;

class Message extends \Magento\Framework\View\Element\Template
{
    public function getMessage()
    {
        echo "Custom Message for product page";
    }

    public function _afterToHtml($html)
    {
        return $html."<p>Custom Message through afterToHtml</p>";
    }
}
