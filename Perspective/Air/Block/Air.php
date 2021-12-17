<?php
namespace Perspective\Air\Block;

class Air extends \Magento\Framework\View\Element\Template
{
    protected $_helperAir;
    protected $_registry;
    protected $_productRepository;
    protected $_productCatalog;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Perspective\Air\Helper\AirHelper $helperAir,
        \Magento\Catalog\Model\Product $productCatalog,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Framework\Registry $registry,
        array $data = [])

    {
        parent::__construct($context, $data);

        $this->_helperAir = $helperAir;
        $this->_registry = $registry;
        $this->_productRepository = $productRepository;
        $this->_productCatalog = $productCatalog;
    }

    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }

    public function getValueAttribute()
    {
        return $this->_productCatalog->load($this->getCurrentProduct()->getId())->getAir();
    }

    public function getEnableModule()
    {
        return $this->_helperAir->getGeneralConfig('enable');
    }

    public function getWeight()
    {
        return $this->_productCatalog->load($this->getCurrentProduct()->getId())->getWeight();
    }

    public function getOverWeight()
    {
        return $this->_helperAir->getGeneralConfig($this->getValueAttribute() . 'X');
    }

    public function getSurcharge()
    {
        return $this->_helperAir->getGeneralConfig($this->getValueAttribute() . 'Y');
    }

    public function getMarkup()
    {
        $difference = $this->getOverWeight() - $this->getWeight();
        return $difference * $this->getSurcharge();
    }
}
