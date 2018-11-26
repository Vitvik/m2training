<?php
namespace Training\Test\Plugin\Model;

class Url
{
    public function beforeGetUrl(
        \Magento\Framework\UrlInterface $subject,
        $routPath = null,
        $routParams = null
    ){
        if ($routPath == 'customer/account/create'){
            return ['customer/account/login', null];
        }
    }

}