<?php

namespace Training\News\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Training_News::post_save';

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    private $postRepository;
    
    private $postFactory;


    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param \Training\News\Api\PostRepositoryInterface $postRepository
     * @param \Training\News\Model\PostFactory $postFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        \Training\News\Api\PostRepositoryInterface $postRepository,
        \Training\News\Model\PostFactory $postFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->postRepository = $postRepository;
        $this->postFactory = $postFactory;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = \Training\News\Model\Post::STATUS_ENABLED;
            }
            if (empty($data['post_id'])) {
                $data['post_id'] = null;
            }

            $model = $this->postFactory->create();

            $id = $this->getRequest()->getParam('post_id');
            if ($id) {
                try {
                    $model = $this->postRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This post no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $this->postRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the post.'));
                $this->dataPersistor->clear('test_post');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['post_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the post.'));
            }

            $this->dataPersistor->set('test_post', $data);
            return $resultRedirect->setPath('*/*/edit', ['post_id' => $this->getRequest()->getParam('post_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
