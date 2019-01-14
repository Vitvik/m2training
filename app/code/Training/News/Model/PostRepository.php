<?php

namespace Training\News\Model;

use Training\News\Api\Data;
use Training\News\Api\PostRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Training\News\Model\ResourceModel\Post as PostResource;
use Training\News\Api\Data\PostInterfaceFactory as PostFactory;
use Training\News\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;

class PostRepository implements PostRepositoryInterface
{
    /**
     * @var PostResource
     */
    private $resource;

    /**
     * @var PostFactory
     */
    private $postFactory;

    /**
     * @var PostCollectionFactory
     */
    private $postCollectionFactory;

    /**
     * @var Data\PostSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param PostResource $resource
     * @param PostFactory $postFactory
     * @param PostCollectionFactory $postCollectionFactory
     * @param Data\PostSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        PostResource $resource,
        PostFactory $postFactory,
        PostCollectionFactory $postCollectionFactory,
        Data\PostSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->postFactory = $postFactory;
        $this->postCollectionFactory = $postCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * Save Page data
     *
     * @param \Training\News\Api\Data\PostInterface $post
     * @return \Training\News\Api\Data\PostInterface
     * @throws CouldNotSaveException
     */
    public function save(\Training\News\Api\Data\PostInterface $post)
    {
        try {
            $this->resource->save($post);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the post: %1', $exception->getMessage()),
                $exception
            );
        }
        return $post;
    }

    /**
     * Load Post data by given Post Identity
     *
     * @param string $postId
     * @return \Training\News\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($postId)
    {
        $post = $this->postFactory->create();
        $this->resource->load($post, $postId);
        if (!$post->getId()) {
            throw new NoSuchEntityException(__('Post with id "%1" does not exist.', $postId));
        }
        return $post;
    }

    /**
     * Load Page data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Training\News\Api\Data\PostSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        /** @var \Training\News\Model\ResourceModel\Post\Collection $collection */
        $collection = $this->postCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        /** @var Data\PostSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Delete Post
     *
     * @param \Training\News\Api\Data\PostInterface $post
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(\Training\News\Api\Data\PostInterface $post)
    {
        try {
            $this->resource->delete($post);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the post: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * Delete Post by given Post Identity
     *
     * @param string $postId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($postId)
    {
        return $this->delete($this->getById($postId));
    }
}
