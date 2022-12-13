<?php
namespace Magetop\Helloworld\Setup;
 
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
 
class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
    $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
     {
        $setup->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        //textfield
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'text_attribute',
            [
                'type' => 'text',
                'label' => 'Text attribute',
                'input' => 'text',
                'source' => '',
                'frontend' => '',
                'backend' => '',
                'required' => false,
                'sort_order' => 500,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'visible' => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front' => true
            ]
        );
        //textarea
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
                'textarea_attribute',
                [
                    'type' => 'text',
                    'backend' => '',
                    'frontend' => '',
                    'label' => 'Textare attribute',
                    'input' => 'textarea',
                    'class' => '',
                    'source' => '',
                    'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
                    'global' => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_GLOBAL,
                    'visible' => true,
                    'required' => false,
                    'sort_order' => 510,
                    'user_defined' => false,
                    'default' => 0,
                    'searchable' => false,
                    'filterable' => true,
                    'comparable' => false,
                    'visible_on_front' => true,
                    'used_in_product_listing' => true,
                    'unique' => false,
                    'apply_to' => '',
                    'is_used_in_grid' => true,
                    'is_visible_in_grid' => true,
                    'is_filterable_in_grid' => true
                ]
            );
        //textarea with editor
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'textarea_with_editor_attribute',
                [
                    'type' => 'text',
                    'backend' => '',
                    'frontend' => '',
                    'label' => 'Textarea with editor',
                    'input' => 'textarea',
                    'class' => '',
                    'source' => '',
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                    'wysiwyg_enabled' => true,
                    'is_html_allowed_on_front' => true,
                    'visible' => true,
                    'required' => false,
                    'sort_order' => 520,
                    'user_defined' => false,
                    'default' => '',
                    'searchable' => false,
                    'filterable' => false,
                    'comparable' => false,
                    'visible_on_front' => false,
                    'used_in_product_listing' => true,
                    'wysiwyg_enabled' => true,
                    'unique' => false,
                    'apply_to' => '',
                    'is_used_in_grid' => true,
                    'is_visible_in_grid' => true,
                    'is_filterable_in_grid' => true
                ]
                );
        //select attribute
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'select_attribute',
                [
                    'label' => 'Select attribute',
                    'type'  => 'text',
                    'input' => 'select',
                    'source' => 'Magetop\Helloworld\Model\Config\Product\Extensionoption',
                    'required' => false,
                    'sort_order' => 530,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                    'used_in_product_listing' => true,
                    'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
                    'visible_on_front' => true,
                    'is_used_in_grid' => true,
                    'is_visible_in_grid' => true,
                    'is_filterable_in_grid' => true
                ]
            );
        //multiselect attribute
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'multiselect_attribute',
                [
                    'label' => 'Multiselect attribute',
                    'type'  => 'text',
                    'input' => 'multiselect',
                    'source' => 'Magetop\Helloworld\Model\Config\Product\Extensionoption',
                    'required' => false,
                    'sort_order' => 540,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                    'used_in_product_listing' => true,
                    'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
                    'visible_on_front' => true,
                    'is_used_in_grid' => true,
                    'is_visible_in_grid' => true,
                    'is_filterable_in_grid' => true
                ]
            );
        $setup->endSetup();
     }
 
    // public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    // {
    //     $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
    //      $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY,
    //      'text_attribute');
    //      $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY,
    //      'textarea_attribute');
    //      $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY,
    //      'textarea_with_editor_attribute');
    //      $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY,
    //      'select_attribute');
    //      $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY,
    //      'multiselect_attribute');
    // }
}
