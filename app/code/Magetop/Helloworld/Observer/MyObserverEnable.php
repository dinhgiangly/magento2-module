<?php

namespace Magetop\Helloworld\Observer; 

use Magento\Framework\Event\ObserverInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product\Attribute\Source\Status;

class MyObserverEnable implements ObserverInterface
{    
    // protected $_logger;
    // protected $productRepository;

    // public function __construct(
    //     \Psr\Log\LoggerInterface $logger
    //     , ProductRepositoryInterface $productRepository
    // )
    // {        
    //     $this->_logger = $logger;
    //     $this->productRepository = $productRepository;
    // }

    // public function execute(\Magento\Framework\Event\Observer $observer)
    // {

    //     $product = $observer->getProduct();
    //     $productId = $product->getId();
    //     $productSku = $product->getSku();
    //     $productStatus = $product->getStatus();
        
        
    //     $stockItem = $product->getExtensionAttributes()->getStockItem();
    //     $stockData = $stockItem->getQty();
    //     $stockStatus = $stockItem->getIsInStock();
        

    //     $salable = $this->getSalableQuantityDataBySku->execute($productSku);
    //     $this->_logger->debug('====================MY LOG=======================');
    //     $this->_logger->debug('Product Id ' . $productId); 
    //     $this->_logger->debug('Product Sku ' . $productSku); 
    //     $this->_logger->debug('Product Status ' . $productStatus);
    //     $this->_logger->debug('Product quantity: ' . $stockData);
    //     $this->_logger->debug('Product stock status: ' . $stockStatus);
    //     $this->_logger->debug('Product sablable quantity: ' . $salable[0]['qty']);
        
    //     if($stockData > 0 && $stockStatus == 1 && $productStatus == 2){

    //         $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    //         $storeManager = $objectManager->create('\Magento\Store\Model\StoreManagerInterface');
    //         $storeIds = array_keys($storeManager->getStores());
    //         $action = $objectManager->create('\Magento\Catalog\Model\ResourceModel\Product\Action');
    //         $updateAttributes['status'] = 1;
    //         $productCollectionFactory = $objectManager->get('\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');
    //         $collection = $productCollectionFactory->create();
    //         $collection->addAttributeToFilter('sku', $productSku);
    //         $collection->addAttributeToSelect('*');
    //         foreach ($collection as $product) 
    //         {
    //             foreach ($storeIds as $storeId) {
    //                 $action->updateAttributes([$product->getId()], $updateAttributes, $storeId);
    //             }
    //         }
    //     }
    // }   

    private $action;

    private $storeManager;

    protected $_logger;

    protected $stockItemRepository;

    public function __construct(
        \Magento\Catalog\Model\ResourceModel\Product\Action $productAction,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Psr\Log\LoggerInterface $logger,
        \Magento\CatalogInventory\Model\Stock\StockItemRepository $stockItemRepository
    ) {
        $this->action = $productAction;
        $this->storeManager = $storeManager;
        $this->_logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) {
        $product = $observer->getProduct();
        $productId = $product->getId();
        $productSku = $product->getSku();
        $productStatus = $product->getStatus();
        $productIds = [$productId];
        $updateAttributes['status'] = 1;
        
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $stockRegistry = $objectManager->get('Magento\CatalogInventory\Api\StockRegistryInterface');
        $stockItem = $stockRegistry->getStockItem($productId);
        $stockStatus= $stockItem->getIsInStock();
        $stockData = $stockItem->getQty();
        $this->_logger->debug('====================MY LOG=======================');
        $this->_logger->debug('Product Id: ' . $productId); 
        $this->_logger->debug('Product Sku: ' .  $productSku);
        $this->_logger->debug('Product List ID: ' . print_r($productIds));
        $this->_logger->debug('Product Data: ' .$stockData);
        $this->_logger->debug('Product Status: ' . $stockStatus);

        $storeIds = array_keys($this->storeManager->getStores());
        if($stockData > 0 && $stockStatus == 1 && $productStatus == 2){
            foreach ($storeIds as $storeId) {
                $this->action->updateAttributes($productIds, $updateAttributes, $storeId);
            }
            $this->_logger->debug('====================DONE=======================');
        }
    }
}