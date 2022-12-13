<?php
namespace Magetop\Helloworld\Controller\Index;
 
use Magento\Framework\App\Action\Action;
 
class Config extends Action
{
 
    protected $resultPageFactory;
	
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	) {
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{	
		$resultPage = $this->resultPageFactory->create();
		return $resultPage;
	}
}