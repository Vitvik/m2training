define(
    [
        'jquery',
        'ko',
        'uiComponent'
    ],
    function ($,ko, Component) {
        "use strict";
        var listCustomers = ko.observableArray([]);
        return Component.extend({
            getListCustomers : function(){

                listCustomers(JSON.parse('[{"entity_id":"1"},{"email":"test@test.ua"},{"created_at":"2018-11-12 10:21:02"},{"firstname":"test"},{"lastname":"test"},{"entity_id":"2"},{"email":"vit@vik.com"},{"created_at":"2018-11-29 08:48:50"},{"firstname":"vit"},{"lastname":"vik"}]'));
                console.log(listCustomers);
                return listCustomers;
            }
        });
    }
);