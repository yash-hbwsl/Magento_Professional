define([
    'jquery',
    'Magento_Ui/js/modal/modal',
    'text!MageMastery_Popup/template/popup.html',
    'mage/cookies'
], function ($, model, template) {
    'use strict';

    return function (settings) {
        const content = settings.content,
              timeout = settings.timeout,
              cookieName = 'magemastery_popup_offered';

        if ($.mage.cookies.get(cookieName)) {
            return;
        }

        const options = {
            type: 'popup',
            responsive: true,
            autoOpen: true,
            modalClass: 'magemastery_popup',
            popupTpl: template,
            closed: function () {
                const date = new Date();
                const thirtyDaysInMinutes = 43200;
                date.setTime(date.getTime() + (thirtyDaysInMinutes * 60 * 1000));
                $.mage.cookies.set(cookieName, '1', {expires: date});
            }
        };

        setTimeout(function () {
            $('<div />').html(content).modal(options);
        }, timeout * 1000);
    }
});
