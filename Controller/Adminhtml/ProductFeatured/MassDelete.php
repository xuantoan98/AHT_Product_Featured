<?php

namespace AHT\ProductFeatured\Controller\Adminhtml\ProductFeatured;

use Magento\Backend\App\Action;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Ui\Component\MassAction\Filter;

/**
 * Class MassDelete
 * @package AHT\ProductFeatured\Controller\Adminhtml\ProductFeatured
 */
class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\Action
     */
    protected $productAction;

    /**
     * MassDelete constructor.
     * @param Action\Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param \Magento\Catalog\Model\ResourceModel\Product\Action $productAction
     */
    public function __construct(
        Action\Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        \Magento\Catalog\Model\ResourceModel\Product\Action $productAction
    )
    {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->productAction = $productAction;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();
        $model = $this->_objectManager->create(\Magento\Catalog\Model\Product::class);
        $resultRedirect = $this->resultRedirectFactory->create();
        foreach ($collection as $item)
        {
            $entityId = intval($item->getEntityId());
            $model->load($entityId);
            $this->productAction->updateAttributes([$entityId], ['is_featured' => '0'], $model->getStoreId());
        }
        $this->messageManager->addSuccessMessage(__('You have deleted the products.'));
        return $resultRedirect->setPath('*/*/');
    }
}


