<?php
namespace Magetop\Helloworld\Helper;
 
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
 
class Data extends AbstractHelper
{
	protected $_storeManager;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
           \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        parent::__construct($context);
         $this->_storeManager = $storeManager;
    }

    const XML_PATH_HELLOWORLD = 'helloworld/';

	public function getConfigValue($field, $storeCode = null)
	{
		return $this->scopeConfig->getValue($field, ScopeInterface::SCOPE_STORE, $storeCode);
	}

	public function getGeneralConfig($fieldid, $storeCode = null)
	{
		return $this->getConfigValue(self::XML_PATH_HELLOWORLD.'general/'.$fieldid, $storeCode);
	}

	public function getBaseUrlMedia()
    {
       return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

	// public function getStorefrontConfig($fieldid, $storeCode = null)
	// {
	// 	return $this->getConfigValue(self::XML_PATH_HELLOWORLD.'storefront/'.$fieldid, $storeCode);
	// }
}