<?php
namespace Training\Webpos\Block\Customer;


class Lists extends \Magento\Framework\View\Element\Template
{
//    public $layoutProcessors;
//
//    public $jsLayout;
    protected $customer;

    public function __construct(
       \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Framework\View\Element\Template\Context $context,
        array $layoutProcessors = [],
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->layoutProcessors = $layoutProcessors;
        $this->customer = $customerFactory;
    }

    public function getJsLayout()
    {
        foreach ($this->layoutProcessors as $processor) {
            $this->jsLayout = $processor->process($this->jsLayout);
        }
        return parent::getJsLayout();
    }

    public function getCustomerCollection(){
        return $this->customer->create()
           ->getCollection();
    }

    public function output(){
        $attribute =[
            'entity_id',
            'email',
            'firstname',
            'lastname',
            'created_at'
        ];
       $customers = [];
        foreach ($this->getCustomerCollection() as  $customer){
            $k =  $customer->getData();
            foreach ($k as $key => $value) {
                if (in_array($key, $attribute)) {
                    $customers[$key] = $value;
                }
            }
            $arr[]= $customers;
        }
        return json_encode($arr);
    }

}