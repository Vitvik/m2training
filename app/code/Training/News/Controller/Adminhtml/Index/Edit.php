<?php

namespace Training\News\Controller\Adminhtml\Index;

use Magento\Framework\Exception\NoSuchEntityException;

class Edit extends \Training\News\Controller\Adminhtml\Index
{
    const ADMIN_RESOURCE = 'Training_News::post_save';
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;
    private $postRepository;
    private $postFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Training\News\Api\PostRepositoryInterface $postRepository,
        \Training\News\Model\PostFactory $postFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->postRepository = $postRepository;
        $this->postFactory = $postFactory;
        parent::__construct($context);
    }

    /**
     * Edit CMS block
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('post_id');
        $model = $this->postFactory->create();
        
        // 2. Initial checking VIA REPOSITORY
        if ($id) {
            try {
                $model = $this->postRepository->getById($id);
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('This post no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        
        // 2. Initial checking VIA RESOURCE MODEL
//        if ($id) {
//            $this->postResource->load($model, $id);
//            if (!$model->getId()) {
//                $this->messageManager->addErrorMessage(__('This post no longer exists.'));
//                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
//                $resultRedirect = $this->resultRedirectFactory->create();
//                return $resultRedirect->setPath('*/*/');
//            }
//        }

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Post') : __('New Post'),
            $id ? __('Edit Post') : __('New Post')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('News'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Post'));
        return $resultPage;
    }
}
