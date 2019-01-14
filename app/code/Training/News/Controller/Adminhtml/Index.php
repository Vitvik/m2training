<?php

namespace Training\News\Controller\Adminhtml;

abstract class Index extends \Magento\Backend\App\Action
{
    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Training_News::post')
            ->addBreadcrumb(__('News'), __('News'));
        return $resultPage;
    }
}
