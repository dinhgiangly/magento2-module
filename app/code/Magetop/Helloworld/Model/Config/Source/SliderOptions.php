<?php
namespace Magetop\Helloworld\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use Magetop\Helloworld\Block\Widget\Posts;
class SliderOptions extends Posts implements ArrayInterface
{
   public function toOptionArray()
   {
        $options = [
            [
                'value' => 'disable',
                'label' => __('Disable')
            ],
            [
                'value' => 'enable',
                'label' => __('Enable')
            ],
            
        ];

        return $options;
    }
}