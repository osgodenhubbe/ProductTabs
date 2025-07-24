<?php declare(strict_types=1);

namespace Slagterlund\ProductTabs\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Catalog\Model\Product;

class AddProductDeclarationAttribute implements DataPatchInterface
{
    private $eavSetupFactory;

    public function __construct(
        EavSetupFactory $eavSetupFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function apply()
    {
        /** @var \Magento\Eav\Setup\EavSetup $eavSetup **/
        $eavSetup = $this->eavSetupFactory->create();

        $eavSetup->addAttribute(
            Product::ENTITY,
            'product_declaration',
            [
                'type'                    => 'text',
                'label'                   => __('Product Declaration'),
                'input'                   => 'textarea',
                'required'                => false,
                'sort_order'              => 200,
                'global'                  => ScopedAttributeInterface::SCOPE_STORE,
                'group'                   => 'Product Details',
                'visible_on_front'        => false,
                // enable WYSIWYG in admin
                'wysiwyg_enabled'         => true,
                'is_html_allowed_on_front'=> true,
            ]
        );
    }

    public static function getDependencies() { return []; }
    public function getAliases() { return []; }
}
