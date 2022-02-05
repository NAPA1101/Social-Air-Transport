<?php
namespace Perspective\SecondTask\Block;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $_registry;
    protected $_productCollectionFactory;
    protected $_helperData;
    protected $_typePrice;
    protected $_productRepository;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Perspective\SecondTask\Helper\Data $helperData,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\Product\Type\Price $typePrice,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        array $data = [])

    {
        parent::__construct($context, $data);
        $this->_registry = $registry;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_helperData = $helperData;
        $this->_typePrice = $typePrice;
        $this->_productRepository = $productRepository;
    }

    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }

    public function getEnabledModule()
    {
        return $this->_helperData->getGeneralConfig('enable');
    }

    public function getEnabledBasePrice()
    {
        return $this->_helperData->getGeneralConfig('base_price');
    }

    public function getEnabledFinalPrice()
    {
        return $this->_helperData->getGeneralConfig('final_price');
    }

    public function getEnabledSpecialPrice()
    {
        return $this->_helperData->getGeneralConfig('special_price');
    }

    public function getEnabledTierPrice()
    {
        return $this->_helperData->getGeneralConfig('tier_price');
    }

    public function getEnabledCatalogRulePrice()
    {
        return $this->_helperData->getGeneralConfig('catalog_rule_price');
    }

    public function getProductCollection()
    {
        $collection = $this->_productCollectionFactory->create();
        return $collection;
    }

    public function getSpecialPrice()
    {
        $product = $this->_productRepository->getById($this->getCurrentProduct());
        return $product->getSpecialPrice();
    }

}


/*12:01	PHP_CodeSniffer
				phpcs: ERROR: PHP_CodeSniffer requires the tokenizer, xmlwriter and SimpleXML extensions to be enabled. Please enable xmlwriter and SimpleXML.
Open PHPCodeSniffer Inspection Settings

12:01	PHP CS Fixer
				PHP CS Fixer: PHP needs to be a minimum version of PHP 5.6.0 and maximum version of PHP 7.4.*.*/
