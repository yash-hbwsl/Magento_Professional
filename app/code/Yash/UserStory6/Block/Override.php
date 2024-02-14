<?php

namespace Yash\UserStory6\Block;

class Override extends \Magento\Framework\View\Element\Template
{

    protected function _toHtml():string
    {
        return "<div>Hello this is coming from to html</div>";
    }

    protected function _afterToHtml($html)
    {
        return $html . "Some extra content";
    }
}
