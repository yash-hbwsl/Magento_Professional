<?php
namespace Yash\UserStory14\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Yash\UserStory14\Block\Email;

class SendProductLowQuantityNotification implements ObserverInterface
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, protected Email $email)
    {
        $this->logger = $logger;
        $this->email = $email;
    }
    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getData('product');
        $this->email->sendEmail($product->getName());
        $this->logger->info('Low quantity notification for product ' . $product->getName());
    }
}
