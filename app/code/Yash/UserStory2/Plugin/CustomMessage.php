<?php

namespace Yash\UserStory2\Plugin;
use Magento\Theme\Block\Html\Footer as Footer;
use Magento\Theme\Block\Html\Header;
use Magento\Catalog\Model\Product as Product;

class CustomMessage{
    
    public function afterGetCopyright(Footer $subject, $result){
        $result="My custom footer";
        return $result;
    }

    public function afterGetWelcome(Header $subject, $result): string
    {
        return "Custom Welcome Message!";
    }

    public function afterGetName(Product $subject, $result){

        if($subject->getFinalPrice()>55 && $subject->getFinalPrice()<60)
        $result.=" On Sale!";
        else if($subject->getFinalPrice()<20)
        $result.="  WholeSale !!";
        else if($subject->getFinalPrice()>=20 && $subject->getFinalPrice()<50)
        $result.="  Super Sale!!";
        if($subject->getFinalPrice()>=50 && $subject->getFinalPrice()<=55)
        $result.="  Premium !!";
        
        return $result;
    }
}
