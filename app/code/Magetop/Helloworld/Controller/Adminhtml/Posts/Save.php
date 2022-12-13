<?php
namespace Magetop\Helloworld\Controller\Adminhtml\Posts;
 
use Magetop\Helloworld\Controller\Adminhtml\Posts;
 
class Save extends Posts
{
    /**
     * @return void
     */
    public function execute()
    {
        $isPost = $this->getRequest()->getPost();
 
        if ($isPost) {
            $postsModel = $this->_postsFactory->create();
            $postsId = $this->getRequest()->getParam('id');
 
            if ($postsId) {
                $postsModel->load($postsId);
            }
            $formData = $this->getRequest()->getParam('post');
            $postsModel->setData($formData);
 
            try {
                // Save news
                $postsModel->save();
 
                // Display success message
                $this->messageManager->addSuccess(__('The news has been saved.'));
 
                // Check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', ['id' => $postsModel->getId(), '_current' => true]);
                    return;
                }
 
                // Go to grid page
                $this->_redirect('*/*/');
                return;
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
 
            $this->_getSession()->setFormData($formData);
            $this->_redirect('*/*/edit', ['id' => $postsId]);
        }
    }
}