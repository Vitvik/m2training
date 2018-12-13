<?php
namespace Training\CustomerPersonalSite\ViewModel;


class CustomerAttribute implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
//    private $urlBuilder;
//
//    public function __construct(
//        \Magento\Framework\UrlInterface $urlBuilder
//    ) {
//        $this->urlBuilder = $urlBuilder;
//    }

    public function getPersonalSite($customerData)
    {
        $attribute = $customerData->getCustomAttribute('personal_site');
        if ($attribute){
            return $attribute->getValue();
        }
        return  '';
    }


}