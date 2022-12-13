 define([
    'jquery',
    'mage/utils/wrapper',
    'Magento_Checkout/js/model/quote'
], function ($, wrapper, quote) {
    'use strict';

    return function (setShippingInformationAction) {

        return wrapper.wrap(setShippingInformationAction, function (originalAction) {
            var shippingAddress = quote.shippingAddress();
            if (shippingAddress['extension_attributes'] === undefined) {
                shippingAddress['extension_attributes'] = {};
            }
            if (shippingAddress.customAttributes) {
                shippingAddress.customAttributes.forEach(function (custom_attribute, index, array) {
                    shippingAddress['extension_attributes'][custom_attribute.attribute_code] = custom_attribute.value;
                });
            }
            return originalAction();
        });
    };
});