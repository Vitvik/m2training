<?php
namespace Training\Storage\Controller\Index;


class Json extends \Magento\Framework\App\Action\Action
{
    protected $jsonResultFactory;

    private $stockState;

    public function __construct(
    \Magento\Framework\App\Action\Context $context,
    \Magento\CatalogInventory\Api\StockStateInterface $stockState,
    \Magento\Framework\Controller\Result\JsonFactory $jsonResultFactory
) {
        $this->stockState = $stockState;
        $this->jsonResultFactory = $jsonResultFactory;
        parent::__construct($context);
}

    public function execute()
    {
        $result = $this->jsonResultFactory->create();
            $productId = $this->getRequest()->getParam('id');
            $result->setData($this->stockState->getStockQty($productId));
            return $result;
    }

}
