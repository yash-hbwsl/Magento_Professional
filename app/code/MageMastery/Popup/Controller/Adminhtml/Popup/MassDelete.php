<?php declare(strict_types=1);

namespace MageMastery\Popup\Controller\Adminhtml\Popup;

use MageMastery\Popup\Api\Data\PopupInterface;
use MageMastery\Popup\Api\PopupRepositoryInterface;
use MageMastery\Popup\Model\ResourceModel\Popup\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action
{
    const ADMIN_RESOURCE = 'MageMastery_Popup::popup';

    public function __construct(
        Context $context,
        private readonly Filter $filter,
        private readonly CollectionFactory $collectionFactory,
        private readonly PopupRepositoryInterface $popupRepository
    ) {
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $collectionSize = $collection->getSize();

            /** @var PopupInterface $popup */
            foreach ($collection as $popup) {
                $this->popupRepository->delete($popup);
            }

            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $collectionSize)
            );
        } catch (\Throwable $exception) {
            $this->messageManager->addErrorMessage(
                __('Something went wrong while processing the operation.')
            );
        }

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $result->setPath('magemastery_popup/popup/index');
    }
}
