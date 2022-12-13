<?php 
namespace Magetop\Helloworld\Observer; 
use Magento\Framework\Event\ObserverInterface; 
use Magento\InventorySalesAdminUi\Model\GetSalableQuantityDataBySku; 
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product\Attribute\Source\Status;
class MyObserver implements ObserverInterface 
{ 
    protected $_logger;
    private $getSalableQuantityDataBySku;
 
    public function __construct(
        \Psr\Log\LoggerInterface $logger, GetSalableQuantityDataBySku $getSalableQuantityDataBySku, ProductRepositoryInterface $productRepository
    )
    {        
        $this->_logger = $logger;
        $this->getSalableQuantityDataBySku = $getSalableQuantityDataBySku;
        $this->productRepository = $productRepository;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
        {
        
            $order = $observer->getEvent()->getOrder();
            $orderId= $order->getIncrementId();
            $this->_logger->debug('====================MY LOG=======================');
            $this->_logger->debug('Order Id' . $orderId); 
            foreach ($order->getAllVisibleItems() as $_item) {
                $this->_logger->debug('Product Id: ' . $_item->getProductId()); 
                $this->_logger->debug('Product Sku: ' . $_item->getSku());
                $this->_logger->debug('Product Name: ' . $_item->getName());
                $this->_logger->debug('Product Type: ' . $_item->getProductType());
                $this->_logger->debug('Product Quantity: ' . $_item->getQtyOrdered());
                $salable = $this->getSalableQuantityDataBySku->execute($_item->getSku());
                $this->_logger->debug('Product sablable quantity: ' . $salable[0]['qty']);
                $currentSalable = $salable[0]['qty'] - $_item->getQtyOrdered();
                $this->_logger->debug('Current product sablable quantity: ' .$currentSalable);
                if($currentSalable == 0){
                    $product = $this->productRepository->get($_item->getSku());
                    $product->setStatus(Status::STATUS_DISABLED);
                    $this->productRepository->save($product);
                    $this->_logger->debug('DISABLED SUCCESSFULLY');
                }
                $this->_logger->debug('--------------------------------------------------');
            }
        }
} 