<?php

namespace Training\News\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'post_id';

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'test_post_collection';

    /**
     * Event object
     *
     * @var string
     */
    protected $_eventObject = 'post_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Training\News\Model\Post::class, \Training\News\Model\ResourceModel\Post::class);
    }
}
