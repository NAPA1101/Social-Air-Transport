<?php

namespace Perspective\Social\Block;

class SocialCategory extends \Magento\Catalog\Block\Product\ListProduct
{
    protected $helperData;
    protected $_productCatalog;

    public function __construct(
        \Perspective\Social\Helper\Data $helperData,
        \Magento\Catalog\Model\Product $_productCatalog,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Data\Helper\PostHelper $postDataHelper,
        \Magento\Catalog\Model\Layer\Resolver $layerResolver,
        \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository,

        array $data = [])

    {
        $this->helperData = $helperData;
        $this->_productCatalog = $_productCatalog;
        parent::__construct($context, $postDataHelper, $layerResolver, $categoryRepository, $urlHelper, $data);
    }

    public function EnableAttribute($id)
    {
        if ($this->helperData->getGeneralConfig('enable')) {
            return $this->_productCatalog->load($id)->getSocial();
        }
    }
}
