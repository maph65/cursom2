define([
    'mage/utils/wrapper',
    'Magento_Checkout/js/model/quote',
    /*'Magento_Checkout/js/model/customer'*/
],function(
    wrapper,
    quote
    /*customer*/
){
    return function(setShippingInformationAction){
        return wrapper.wrap(setShippingInformationAction,function(originalAction){

            var shippingAddress = quote.shippingAddress();

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
            console.log('Se seteo la dirección de envío');
            console.log('Shipping Address: ');
            console.log(shippingAddress);
            return originalAction();

        });
    }
});
