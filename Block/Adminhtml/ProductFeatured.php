<?php
namespace AHT\ProductFeatured\Block\Adminhtml;

/**
 * Class ProductFeatured
 * @package AHT\ProductFeatured\Block\Adminhtml
 */
class ProductFeatured extends \Magento\Backend\Block\Widget\Grid\Container
{
    public function _construct()
    {
        $this->_blockGroup = 'AHT_ProductFeatured';
        $this->_controller = 'adminhtml_productfeatured';
        parent::_construct();
    }
}
