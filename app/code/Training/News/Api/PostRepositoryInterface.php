<?php

namespace Training\News\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface PostRepositoryInterface
{
    /**
     * Save post.
     *
     * @param \Training\News\Api\Data\PostInterface $post
     * @return \Training\News\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Training\News\Api\Data\PostInterface $post);

    /**
     * Retrieve post.
     *
     * @param int $postId
     * @return \Training\News\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($postId);

    /**
     * Retrieve posts matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Training\News\Api\Data\PostSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete post.
     *
     * @param \Training\News\Api\Data\PostInterface $post
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Training\News\Api\Data\PostInterface $post);

    /**
     * Delete post by ID.
     *
     * @param int $postId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($postId);
}
