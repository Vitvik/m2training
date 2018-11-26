<?php
namespace Training\TestRedirect\Controller\Product;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class View extends \Magento\Catalog\Controller\Product\View
{
    private $customerSession;
    private $redirect;

    public function __construct(
        Context $context,
        \Magento\Catalog\Helper\Product\View $viewHelper,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory,
        PageFactory $resultPageFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory
    )
    {
        $this->customerSession = $customerSession;
        $this->redirect = $resultRedirectFactory;
        parent::__construct($context, $viewHelper, $resultForwardFactory, $resultPageFactory);
    }

    public function Execute()
    {
        if(!$this->customerSession->isLoggedIn()) {
            $result = $this->redirect->create();
            return  $result->setPath('customer/account/login');
        }
        return parent::execute();
    }
}