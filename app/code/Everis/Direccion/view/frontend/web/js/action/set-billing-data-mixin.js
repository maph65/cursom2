define([
    'mage/utils/wrapper',
    'Magento_Checkout/js/model/quote'
],function(wrapper,quote){
    return function (placeOrderAction) {
        return wrapper.wrap(placeOrderAction,function (originalAction){
            var billingAddress = quote.billingAddress();
            var shippingAddress = quote.shippingAddress();
            if(typeof billingAddress['extension_attributes'] == 'undefined'){
                billingAddress['extension_attributes'] = {};
            }
            var num_int = '', num_ext = '', neighborhood = '';
            if(typeof billingAddress.customAttributes !== 'undefined' &&
            billingAddress.customAttributes.length > 0){
                var field;
                for(field in billingAddress.customAttributes){
                    if(billingAddress.customAttributes[field]['attribute_code'] &&
                        billingAddress.customAttributes[field]['attribute_code'] === 'num_int'){
                        num_int = billingAddress.customAttributes[field]['value'];
                    }else if(billingAddress.customAttributes[field]['attribute_code'] &&
                        billingAddress.customAttributes[field]['attribute_code'] === 'num_ext'){
                        num_ext = billingAddress.customAttributes[field]['value'];
                    }else if(billingAddress.customAttributes[field]['attribute_code'] &&
                        billingAddress.customAttributes[field]['attribute_code'] === 'neighborhood'){
                        neighborhood = billingAddress.customAttributes[field]['value'];
                    }
                }
                billingAddress.extension_attributes.num_int = num_int;
                billingAddress.extension_attributes.num_ext = num_ext;
                billingAddress.extension_attributes.neighborhood = neighborhood;
            }


            if(typeof shippingAddress['extension_attributes'] == 'undefined'){
                shippingAddress['extension_attributes'] = {};
            }
            var num_int = '', num_ext = '', neighborhood = '';
            if(typeof shippingAddress.customAttributes !== 'undefined' &&
                shippingAddress.customAttributes.length > 0){
                var field;
                for(field in shippingAddress.customAttributes){
                    if(shippingAddress.customAttributes[field]['attribute_code'] &&
                        shippingAddress.customAttributes[field]['attribute_code'] === 'num_int'){
                        num_int = shippingAddress.customAttributes[field]['value'];
                    }else if(shippingAddress.customAttributes[field]['attribute_code'] &&
                        shippingAddress.customAttributes[field]['attribute_code'] === 'num_ext'){
                        num_ext = shippingAddress.customAttributes[field]['value'];
                    }else if(shippingAddress.customAttributes[field]['attribute_code'] &&
                        shippingAddress.customAttributes[field]['attribute_code'] === 'neighborhood'){
                        neighborhood = shippingAddress.customAttributes[field]['value'];
                    }
                }
                shippingAddress.extension_attributes.num_int = num_int;
                shippingAddress.extension_attributes.num_ext = num_ext;
                shippingAddress.extension_attributes.neighborhood = neighborhood;
            }
            console.log('Se seteo la dirección de envío y facturación');
            console.log('Billing Address: ');
            console.log(billingAddress);
            console.log('Shipping Address: ');
            console.log(shippingAddress);
            return originalAction();
        });
    }
});
