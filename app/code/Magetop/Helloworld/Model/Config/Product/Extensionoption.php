<?php
namespace Magetop\Helloworld\Model\Config\Product;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Extensionoption extends AbstractSource
{
    protected $optionFactory;

    public function getAllOptions()
    {
        $this->_options = [];
        $this->_options[] = ['label' => 'Vegan Friendly', 'value' => 'vegan'];
        $this->_options[] = ['label' => 'Made in UK', 'value' => 'madeinuk'];
        $this->_options[] = ['label' => 'Eco friendly', 'value' => 'eco'];

        return $this->_options;
    }


}