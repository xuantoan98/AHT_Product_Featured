<?php

namespace AHT\ProductFeatured\Block\Catalog\Product;

class ProductFeatured extends \Magento\Framework\View\Element\Template
{
    protected $collectionFactory;
    protected $categoryFactory;

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

    public function getProductFeaturedCollection()
    {
        $collection = $this->collectionFactory->create();
        $collection
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('is_featured', '1')
            ->load();

        return $collection;
    }
}

