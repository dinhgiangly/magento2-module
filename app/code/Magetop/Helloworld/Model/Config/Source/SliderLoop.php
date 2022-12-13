<?php
namespace Magetop\Helloworld\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use Magetop\Helloworld\Block\Widget\Posts;
class SliderLoop extends Posts implements ArrayInterface
{
   public function toOptionArray()
   {
        $options = [
            [
                'value' => 'false',
                'label' => __('Disable')
            ],
            [
                'value' => 'true',
                'label' => __('Enable')
            ],
            
        ];

        return $options;
    }
}