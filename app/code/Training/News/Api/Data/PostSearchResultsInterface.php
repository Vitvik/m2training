<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Training\News\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PostSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get pages list.
     *
     * @return \Training\News\Api\Data\PostInterface[]
     */
    public function getItems();

    /**
     * Set pages list.
     *
     * @param \Training\News\Api\Data\PostInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
