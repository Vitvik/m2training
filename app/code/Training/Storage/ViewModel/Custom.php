<?php
namespace Training\Storage\ViewModel;


class Custom implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    protected $registry;

    public function __construct(
        \Magento\Framework\Registry $registry
    ) {
        $this->registry = $registry;
    }

    public function getCurrentProductId()
    {
        return $this->registry->registry('current_product')->getId();
    }

}