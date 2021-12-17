<?php

namespace Perspective\Social\Block;

class Social extends \Magento\Framework\View\Element\Template
{
    protected $helperData;
    protected $_registry;
    protected $_productRepository;
    protected $_productCatalog;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Perspective\Social\Helper\Data $helperData,
        \Magento\Catalog\Model\Product $productCatalog,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Framework\Registry $registry,
        array $data = [])

    {
        parent::__construct($context, $data);

        $this->helperData = $helperData;
        $this->_registry = $registry;
        $this->_productRepository = $productRepository;
        $this->_productCatalog = $productCatalog;
    }

    public function EnablePercent()
    {
        if ($this->helperData->getGeneralConfig('enable') == 1) {
            return $this->helperData->getGeneralConfig('percent');
        }
    }

    public function CurrentProduct() {
        return $this->_registry->registry('current_product');
    }

    public function PriceProduct() {
        return $this->_productRepository->getById($this->CurrentProduct()->getId() - 1)->getPrice();
    }

    public function EnableCustomAttribute()
    {
        if ($this->helperData->getGeneralConfig('enable')) {
            return $this->_productCatalog->load($this->CurrentProduct()->getId())->getSocial();
        }
    }

    public function DiscountPrice()
    {
        return $this->PriceProduct() * (100 - $this->EnablePercent()) / 100;
    }
}
