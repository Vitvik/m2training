<?php

namespace Training\News\Model;

use Training\News\Api\Data\PostInterface;
use Magento\Framework\Model\AbstractModel;

class Post extends AbstractModel implements PostInterface
{
    /**#@+
     * Post's statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'training_post';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Training\News\Model\ResourceModel\Post::class);
    }

    /**
     * Retrieve post id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::POST_ID);
    }

    /**
     * Retrieve post identifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        return (string)$this->getData(self::IDENTIFIER);
    }

    /**
     * Retrieve post title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Retrieve post content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Retrieve post creation time
     *
     * @return string
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Retrieve post update time
     *
     * @return string
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Is active
     *
     * @return bool
     */
    public function isActive()
    {
        return (bool)$this->getData(self::IS_ACTIVE);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PostInterface
     */
    public function setId($id)
    {
        return $this->setData(self::POST_ID, $id);
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return PostInterface
     */
    public function setIdentifier($identifier)
    {
        return $this->setData(self::IDENTIFIER, $identifier);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return PostInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return PostInterface
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return PostInterface
     */
    public function setCreationTime($creationTime)
    {
        return $this->setData(self::CREATION_TIME, $creationTime);
    }

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return PostInterface
     */
    public function setUpdateTime($updateTime)
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }

    /**
     * Set is active
     *
     * @param bool|int $isActive
     * @return PostInterface
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Prepare post's statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
}
