<?php
namespace Yash\UserStory2\Plugin;

use \Magento\Theme\Block\Html\Breadcrumbs;

class Breadcrumb
{
    // This is probably the "correct" way to account for this scenario
    public function beforeAddCrumb(Breadcrumbs $breadcrumbs, $crumbName, $crumbInfo)
    {
        if (isset($crumbInfo['label'])) {
            // This is where you can modify the breadcrumb text
            $crumbInfo['label'] = __('Hummingbird ' .$crumbInfo['label']);
        }

        return [
            $crumbName,
            $crumbInfo,
        ];
    }
}