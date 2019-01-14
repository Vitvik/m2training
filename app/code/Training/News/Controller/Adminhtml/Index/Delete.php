<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Training\News\Controller\Adminhtml\Index;

use Magento\Framework\Exception\LocalizedException;
use Magento\Backend\App\Action\Context;

class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Training_News::post_delete';

    private $postRepository;
    
    /**
     * @param \Training\News\Controller\Adminhtml\Index\Context $context
     * @param \Training\News\Api\PostRepositoryInterface $postRepository
     */
    public function __construct(
        Context $context,
        \Training\News\Api\PostRepositoryInterface $postRepository
    ) {
        $this->postRepository = $postRepository;
        parent::__construct($context);
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('post_id');
        if ($id) {
            try {
                $this->postRepository->deleteById($id);
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the post.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['post_id' => $id]);
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage(__('We can\'t delete the post.'));
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['post_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a post to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
