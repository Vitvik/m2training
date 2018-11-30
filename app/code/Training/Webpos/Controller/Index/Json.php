<?php
namespace Training\Webpos\Controller\Index;


class Json extends \Magento\Framework\App\Action\Action
{
    protected $jsonResultFactory;

    protected $block;

    public function __construct(
    \Magento\Framework\App\Action\Context $context,
    \Magento\Framework\Controller\Result\JsonFactory $jsonResultFactory,
    \Training\Webpos\Block\Customer\Lists $block
) {
    $this->jsonResultFactory = $jsonResultFactory;
    $this->block = $block;
    parent::__construct($context);
}

    public function execute()
{
    $result = $this->jsonResultFactory->create();
    $result->setData($this->block->output());
//    var_dump($result);
    return $result;
}
}
