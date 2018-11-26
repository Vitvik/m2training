<?php
namespace Training\Render\Controller\Layout;


class OneColumn extends \Magento\Framework\App\Action\Action
{
    protected $pageResultFactory;

    public function __construct(
        \Magento\Framework\View\Result\PageFactory $pageResultFactory,
        \Magento\Framework\App\Action\Context $context

)   {
        $this->pageResultFactory = $pageResultFactory;
        parent::__construct($context);
    }

    public function Execute()
    {

        $result = $this->pageResultFactory->create();
        return $result;

    }
}

