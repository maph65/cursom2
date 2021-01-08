define([
    'underscore',
    'uiRegistry',
    'Magento_Ui/js/form/element/select'
], function (_, registry, Select) {
    'use strict';

    return Select.extend({
        defaults: {
            imports: {
                update: '${ $.parentName }.postcode:value'
            }
        },

        /**
         * @param {String} value
         */
        onUpdate: function () {
            var nb = this.value();
            if(typeof nb !== 'undefined' && nb.length > 0){
                registry.get(this.parentName + '.' + 'neighborhood', function (input) {
                    input.value(nb);
                    input.setVisible(false);
                });
            }
        }
    });
});
