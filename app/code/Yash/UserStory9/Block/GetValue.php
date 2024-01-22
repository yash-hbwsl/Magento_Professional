<?php

namespace Yash\UserStory9\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;

class GetValue extends Template
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * YourClass constructor.
     *
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Fetch admin configuration value
     *
     * @return mixed
     */
    public function getAdminConfigValue()
    {
        // Use the scopeConfig to fetch the configuration value
        $configValue = $this->scopeConfig->getValue(
            'mod9/customconfig_group/text_to_display',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

        return $configValue;
    }
}
