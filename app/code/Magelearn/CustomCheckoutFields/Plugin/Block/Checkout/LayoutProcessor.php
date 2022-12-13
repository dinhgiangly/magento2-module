<?php

namespace Magelearn\CustomCheckoutFields\Plugin\Block\Checkout;

class LayoutProcessor
{
    /**
     * Process js Layout of block
     *
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(\Magento\Checkout\Block\Checkout\LayoutProcessor $subject, $jsLayout)
    {
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['delivery_date'] = $this->processDeliveryDateAddress('shippingAddress');

        return $jsLayout;
    }

    /**
     * Process provided address.
     *
     * @param string $dataScopePrefix
     * @return array
     */
    private function processDeliveryDateAddress($dataScopePrefix)
    {
        return [
            'component' => 'Magento_Ui/js/form/element/date',
            'config' => [
                'customScope' => $dataScopePrefix.'.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/date',
                'id' => 'delivery_date',
                'options' => [
                    'dateFormat' => 'y-MM-dd'
                ]
            ],
            'dataScope' => $dataScopePrefix.'.custom_attributes.delivery_date',
            'label' => __('Delivery Date'),
            'provider' => 'checkoutProvider',
            'validation' => [
               'required-entry' => true
            ],
            'sortOrder' => 201,
            'visible' => true,
            'imports' => [
                'initialOptions' => 'index = checkoutProvider:dictionaries.delivery_date',
                'setOptions' => 'index = checkoutProvider:dictionaries.delivery_date'
            ]
        ];
    }
}