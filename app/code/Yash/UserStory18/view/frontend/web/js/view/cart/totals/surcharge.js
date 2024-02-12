define([
    'Magento_Checkout/js/view/summary/abstract-total',
    'Magento_Checkout/js/model/quote'
], function (Component, quote) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Yash_UserStory18/summary/surcharge'
        },
        totals: quote.getTotals(),

        /**
         * @return {*|Boolean}
         */
        isDisplayed: function () {
            return this.isFullMode() && this.getPureValue() != 0;
        },

        /**
         * Get surcharge title
         *
         * @returns {null|String}
         */
        getTitle: function () {
            if (!this.totals()) {
                return null;
            }

            return 'Custom Surcharge';
        },

        /**
         * @return {Number}
         */
        getPureValue: function () {
            var price = 0;
            for (var i=0; i < window.checkoutConfig.quoteItemData.length; i++) {
              price += window.checkoutConfig.quoteItemData[i].qty * 1.79;
            }

            return price;
        },

        /**
         * @return {*|String}
         */
        getValue: function () {
            return this.getFormattedPrice(this.getPureValue());
        }
    });
});
