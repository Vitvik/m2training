<?php
namespace Training\Webpos\Block\Customer;


class Lists extends \Magento\Framework\View\Element\Template
{
//    public $layoutProcessors;
//
//    public $jsLayout;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $layoutProcessors = [],
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->layoutProcessors = $layoutProcessors;
    }

    public function getJsLayout()
    {
        foreach ($this->layoutProcessors as $processor) {
            $this->jsLayout = $processor->process($this->jsLayout);
        }
        return parent::getJsLayout();
    }
}