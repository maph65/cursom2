var config = {
    config:{
        mixins:{
            'Magento_Checkout/js/action/set-shipping-information':{
                'Everis_Direccion/js/action/set-shipping-data-mixin': true
            },
            'Magento_Checkout/js/action/set-billing-address':{
                'Everis_Direccion/js/action/set-billing-data-mixin': true
            },
            'Magento_Checkout/js/action/place-order':{
                'Everis_Direccion/js/action/set-billing-data-mixin': true
            },
        }
    }
};
