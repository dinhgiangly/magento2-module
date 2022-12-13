<?php
namespace Magelearn\CustomImage\Model\Category;
 
use Magento\Framework\App\ObjectManager;
use Magento\Catalog\Model\Category\FileInfo;
 
class DataProvider extends \Magento\Catalog\Model\Category\DataProvider
{
 
    /**
     * @var Filesystem
     */
    private $fileInfo;
 
    public function getData()
    {
        $data = parent::getData();
        $category = $this->getCurrentCategory();
        if ($category) {
            $categoryData = $category->getData();
            $categoryData = $this->addUseConfigSettings($categoryData);
            $categoryData = $this->filterFields($categoryData);
            //$categoryData = $this->convertValues($category, $categoryData);
 
            $this->loadedData[$category->getId()] = $categoryData;
        }
 
        if (isset($data['custom_image'])) {
            unset($data['custom_image']);
        }
 
        return $data;
    }
 
    protected function getFieldsMap()
    {
        $fields = parent::getFieldsMap();
        $fields['content'][] = 'custom_image'; // custom image field
 
        return $fields;
    }
 
    /**
     * Get FileInfo instance
     *
     * @return FileInfo
     *
     * @deprecated 101.1.0
     */
    private function getFileInfo()
    {
        if ($this->fileInfo === null) {
            $this->fileInfo = ObjectManager::getInstance()->get(FileInfo::class);
        }
        return $this->fileInfo;
    }
}