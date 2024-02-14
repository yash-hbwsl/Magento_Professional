<?php

namespace Yash\UserStory14\Block;

use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;

class Email extends Template
{
    protected TransportBuilder $transportBuilder;
    protected StoreManagerInterface $storeManager;
    protected Context $context;
    public function __construct(
        Context $context,
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
    ) {
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    public function sendEmail(string $productName):void
    {
        $templateId = 'custom_mail_template'; // template id
        $fromEmail = 'yash.wankhade@hbwsl.com';  // sender Email id
        $fromName = 'Admin';             // sender Name
        $toEmail = 'yash.wankhade@hbwsl.com'; // receiver email id

        try {
            // template variables pass here
            $templateVars = [
                'product' => $productName,
            ];

            $storeId = $this->storeManager->getStore()->getId();

            $from = ['email' => $fromEmail, 'name' => $fromName];

            $templateOptions = [
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => $storeId
            ];
            $transport = $this->transportBuilder->setTemplateIdentifier($templateId)
                ->setTemplateOptions($templateOptions)
                ->setTemplateVars($templateVars)
                ->setFrom($from)
                ->addTo($toEmail)
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->_logger->info($e->getMessage());
        }
    }
}
