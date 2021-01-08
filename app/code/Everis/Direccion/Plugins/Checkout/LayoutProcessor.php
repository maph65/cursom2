<?php

namespace Everis\Direccion\Plugins\Checkout;
use \Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Store\Model\ScopeInterface;

class LayoutProcessor{


    protected $scope;

    public function __construct(ScopeConfigInterface $scope) {
        $this->scope = $scope;
    }

    /*public function beforeProcess(){

    }*/

    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(\Magento\Checkout\Block\Checkout\LayoutProcessor $subject, array $jsLayout) {

        /* Shipping Address Layout */
        $numIntAttributeCode = 'num_int';
        $numIntField = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                // customScope is used to group elements within a single form (e.g. they can be validated separately)
                'customScope' => 'shippingAddress.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input',
            ],
            'dataScope' => 'shippingAddress.custom_attributes' . '.' . $numIntAttributeCode,
            'label' => 'No. Interior',
            'provider' => 'checkoutProvider',
            'sortOrder' => 74,
            'validation' => [
                'required-entry' => false, "max_text_length" => 100
            ],
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
        ];

        $numExtAttributeCode = 'num_ext';
        $numExtField = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                // customScope is used to group elements within a single form (e.g. they can be validated separately)
                'customScope' => 'shippingAddress.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input',
            ],
            'dataScope' => 'shippingAddress.custom_attributes' . '.' . $numExtAttributeCode,
            'label' => 'No. Exterior',
            'provider' => 'checkoutProvider',
            'sortOrder' => 72,
            'validation' => [
                'required-entry' => true, "max_text_length" => 100
            ],
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
        ];



        $neighborhoodAttributeCode = 'neighborhood';
        $neighborhoodField = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                // customScope is used to group elements within a single form (e.g. they can be validated separately)
                'customScope' => 'shippingAddress.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input',
            ],
            'dataScope' => 'shippingAddress.custom_attributes' . '.' . $neighborhoodAttributeCode,
            'label' => 'Neighborhood',
            'provider' => 'checkoutProvider',
            'sortOrder' => 105,
            'validation' => [
                'required-entry' => true
            ],
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
        ];


        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['postcode']['sortOrder'] = 76;
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$numIntAttributeCode] = $numIntField;
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$numExtAttributeCode] = $numExtField;
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$neighborhoodAttributeCode] = $neighborhoodField;


        /* Billing Address Layout */
        $methodList = $this->scope->getValue('payment');
        //$paymentListsOpt = $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-lists']['children'];
        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children'])
            && !empty($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']) && !empty($methodList)) {

            $configuration = $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['afterMethods']['children'];
            foreach ($configuration as $paymentGroup => $groupConfig) {
                if (isset($groupConfig['component']) AND $groupConfig['component'] === 'Magento_Checkout/js/view/billing-address') {

                    //unset($paymentList[$idPayment . '-form']['children']['form-fields']['children']['neighborhood']);
                    $numIntAttributeCode = 'num_int';
                    $numIntField = [
                        'component' => 'Magento_Ui/js/form/element/abstract',
                        'config' => [
                            'customScope' => 'billingAddress',
                            'customEntry' => null,
                            'template' => 'ui/form/field',
                            'elementTmpl' => 'ui/form/element/input',
                        ],

                        'dataScope' => $groupConfig['dataScopePrefix'] . '.custom_attributes.' . $numIntAttributeCode,
                        'label' => 'No. Interior',
                        'provider' => 'checkoutProvider',
                        'sortOrder' => 74,
                        'validation' => [
                            'required-entry' => false, "max_text_length" => 100
                        ],
                        'filterBy' => null,
                        'customEntry' => null,
                        'visible' => true,
                    ];


                    $numExtAttributeCode = 'num_ext';
                    $numExtField = [
                        'component' => 'Magento_Ui/js/form/element/abstract',
                        'config' => [
                            // customScope is used to group elements within a single form (e.g. they can be validated separately)
                            'customScope' => 'billingAddress',
                            'customEntry' => null,
                            'template' => 'ui/form/field',
                            'elementTmpl' => 'ui/form/element/input',
                        ],
                        'dataScope' => $groupConfig['dataScopePrefix'] . '.custom_attributes.' . $numExtAttributeCode,
                        'label' => 'No. Exterior',
                        'provider' => 'checkoutProvider',
                        'sortOrder' => 72,
                        'validation' => [
                            'required-entry' => true, "max_text_length" => 100
                        ],
                        'filterBy' => null,
                        'customEntry' => null,
                        'visible' => true,
                    ];


                    $neighborhoodField = [
                        'component' => 'Magento_Ui/js/form/element/abstract',
                        'config' => [
                            // customScope is used to group elements within a single form (e.g. they can be validated separately)
                            'customScope' => 'billingAddress',
                            'customEntry' => null,
                            'template' => 'ui/form/field',
                            'elementTmpl' => 'ui/form/element/input',
                        ],
                        'dataScope' => $groupConfig['dataScopePrefix'] . '.custom_attributes.' . $neighborhoodAttributeCode,
                        'label' => 'Colonia',
                        'provider' => 'checkoutProvider',
                        'sortOrder' => 105,
                        'validation' => [
                            'required-entry' => true
                        ],
                        'filterBy' => null,
                        'customEntry' => null,
                        'visible' => true,
                    ];


                    $configuration['billing-address-form']['children']['form-fields']['children']['postcode']['sortOrder'] = 76;

                    $configuration['billing-address-form']['children']['form-fields']['children'][$numIntAttributeCode] = $numIntField;
                    $configuration['billing-address-form']['children']['form-fields']['children'][$numExtAttributeCode] = $numExtField;
                    $configuration['billing-address-form']['children']['form-fields']['children'][$neighborhoodAttributeCode] = $neighborhoodField;
                }
            }
            $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['afterMethods']['children']  = $configuration;
        }

        return $jsLayout;
    }

    /*public function aroundProcess(){

    }*/

    /*public function aroundGetHolamundo(callable $proceed){
        //todo before
        $holamundo = $proceed();
        //todo after
        $holamundo = 'Hello world';
        return $holamundo;
    }*/

}
