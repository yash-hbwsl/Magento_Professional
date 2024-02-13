<?php

namespace Yash\UserStory5\Plugin;

class Description
{
    public function afterToHtml(\Magento\Catalog\Block\Product\View\Description $subject, $result)
    {
        $result.="This is a sample description for the product description";
        return $result;
    }
}
