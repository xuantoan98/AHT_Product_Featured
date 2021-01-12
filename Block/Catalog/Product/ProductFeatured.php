<?php

namespace AHT\ProductFeatured\Block\Catalog\Product;

/**
 * Class ProductFeatured
 * @package AHT\ProductFeatured\Block\Catalog\Product
 */
class ProductFeatured extends \Magento\Framework\View\Element\Template
{
    protected $collectionFactory;
    protected $categoryFactory;

    /**
     * ProductFeatured constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory
     * @param \Magento\Catalog\Model\CategoryFactory $categoryFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        array $data = []
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->categoryFactory = $categoryFactory;
        parent::__construct($context, $data);
    }

    /**
     *
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getProductFeaturedCollection()
    {
        $collection = $this->collectionFactory->create();
        $collection
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('is_featured', '1');


        $collection->getSelect()->join(
            array('ccp' => 'catalog_category_product'),
            'e.entity_id = ccp.entity_id'
        );

        return $collection;
    }
}

