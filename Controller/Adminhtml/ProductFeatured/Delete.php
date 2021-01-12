<?php

namespace AHT\ProductFeatured\Controller\Adminhtml\ProductFeatured;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;

/**
 * Class Delete
 * @package AHT\ProductFeatured\Controller\Adminhtml\ProductFeatured
 */
class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\Action
     */
    protected $productAction;

    /**
     * Delete constructor.
     * @param Action\Context $context
     * @param \Magento\Catalog\Model\ResourceModel\Product\Action $productAction
     */
    public function __construct(
        Action\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\Action $productAction
    )
    {
        $this->productAction = $productAction;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface
     * \Magento\Framework\Controller\Result\Redirect
     * \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        if(isset($id))
        {
            try {
                $id = intval($id);
                $model = $this->_objectManager->create(\Magento\Catalog\Model\Product::class);
                $model->load($id);
                $this->productAction->updateAttributes([$id], ['is_featured' => '0'], $model->getStoreId());

                $this->messageManager->addSuccessMessage(__('You have deleted the product.'));
                return $resultRedirect->setPath('*/*/');
            }
            catch (\Exception $e)
            {
                echo "Error: " . $e;
            }
        }
    }
}
