define([
    'jquery',
    'mage/translate',
    'jquery/ui'
], function ($, $t) {
    'use strict';

    return function (widget) {

        $.widget('mage.catalogAddToCart', widget, {
            submitForm: function (form) {
                if (confirm($t('Are yuo sure?'))) {
                    this._super(form);
                } else {
                    return false;
                }

            }
        });
        return $.mage.catalogAddToCart;
    }
});
