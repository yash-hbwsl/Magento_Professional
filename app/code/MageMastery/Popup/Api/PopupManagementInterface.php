<?php declare(strict_types=1);

namespace MageMastery\Popup\Api;

use MageMastery\Popup\Api\Data\PopupInterface;

interface PopupManagementInterface
{
    /**
     * @return PopupInterface
     */
    public function getApplicablePopup(): PopupInterface;
}
