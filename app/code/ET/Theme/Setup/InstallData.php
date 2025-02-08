<?php

namespace ET\Theme\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

/**
 * InstallData for setting up custom attributes
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var EavSetupFactory
     */
    private EavSetupFactory $eavSetupFactory;

    /**
     * Constructor
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * Install method to add attributes
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        // Add custom attribute "is_featured"
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'is_featured',
            [
                'group' => 'Product Details',
                'type' => 'int',
                'sort_order' => 102,
                'backend' => '',
                'frontend' => '',
                'label' => 'Is Featured?',
                'input' => 'boolean',
                'class' => '',
                'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL, // Updated for Magento 2.4.7
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'simple,configurable,virtual,bundle,downloadable'
            ]
        );

        $setup->endSetup();
    }
}
