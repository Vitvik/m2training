<?php
namespace Training\Webpos\Block\Customer;


class Lists extends \Magento\Framework\View\Element\Template
{
//    public $layoutProcessors;
//
//    public $jsLayout;
    protected $customer;

    public function __construct(
        \Magento\Customer\Model\Customer $customers,
        \Magento\Framework\View\Element\Template\Context $context,
        array $layoutProcessors = [],
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->layoutProcessors = $layoutProcessors;
        $this->customer = $customers;
    }

    public function getJsLayout()
    {
        foreach ($this->layoutProcessors as $processor) {
            $this->jsLayout = $processor->process($this->jsLayout);
        }
        return parent::getJsLayout();
    }

    public function getCustomerCollection(){
        return $this->customer->getCollection()
//        ->addAttributeToSelect([
//            'entity_id',
//            'email',
//            'firstname',
//            'lastname',
//            'created_at'
//        ])
        ->load();
    }

    public function output(){
       $customers = [];
        foreach ($this->getCustomerCollection() as $customer){
            $customers[] = $customer->getData();

        }
        return $customers;
    }

}