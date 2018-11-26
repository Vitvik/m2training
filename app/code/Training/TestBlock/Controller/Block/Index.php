<?php
namespace Training\TestBlock\Controller\Block;


class Index extends \Magento\Framework\App\Action\Action
{
    private $layoutFactory;
    private $resultRawFactory;

    public function __construct(

        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
)   {
        $this->resultRawFactory = $resultRawFactory;
        $this->layoutFactory = $layoutFactory;
        parent::__construct($context);
    }

    public function execute()
    {
       $layout = $this->layoutFactory->create();
       $block =  $layout->createBlock('Training\TestBlock\Block\Test');
//       $this->getResponse()->appendBody($block->toHtml());
        $resultRaw = $this->resultRawFactory->create();
        $resultRaw->setContents($block->toHtml());
        return $resultRaw;
    }
}