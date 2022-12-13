<?php
 
namespace Magelearn\CustomImage\Helper;
 
use Magento\Framework\App\Helper\AbstractHelper;
 
class Category extends AbstractHelper
{
    /**
     * @return array
     */
    public function getAdditionalImageTypes()
    {
        return array('custom_image');
    }
 
    /**
     * Retrieve image URL
     * @param $image
     * @return string
     */
    public function getImageUrl($image)
    {
        $url = false;
        //$image = $this->getImage();
        if ($image) {
            if (is_string($image)) {
                $url = $this->_urlBuilder->getBaseUrl() . $image;
                //$url = $image;
            } else {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('Something went wrong while getting the image url.')
                );
            }
        }
        return $url;
    }
 
}