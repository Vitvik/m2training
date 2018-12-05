define([
    'uiComponent',
    'jquery',
    'ko'
], function (Component, $, ko) {
    'use strict';

    return Component.extend({
        quantity: ko.observable(''),
        visible: ko.observable(false),
        productId: config.productId,
        url:config.url,
        getQuantity : function(){
            this.visible(true);
            var self = this;
           $.ajax({
                url:self.url,
                type: 'post',
                dataType: 'json',
                data:{id:self.productId},
                })
               .done( function (data) {
                   if(data) {
                       self.quantity(data);
                   }

           })
        }

    });
});