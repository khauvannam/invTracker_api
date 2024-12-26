<?php

namespace App\Services\Item;

use App\Repositories\Item\ItemRelationshipRepository;
use App\Models\Item\ItemRelationship;

class ItemRelationshipService
{
    protected $repository;

    public function __construct(ItemRelationshipRepository $repository)
    {
        $this->repository = $repository;
    }

    // Tạo mới mối quan hệ giữa item và tag
    public function createItemRelationship($itemId, $data)
    {
        return $this->repository->createItemRelationship($itemId, $data);
    }

    // Lấy tất cả mối quan hệ của item
    public function getItemRelationships($itemId)
    {
        return $this->repository->getItemRelationshipsByItemId($itemId);
    }

    // Xóa mối quan hệ của item
    public function deleteItemRelationship($itemId, $relationshipId)
    {
        return $this->repository->deleteItemRelationship($itemId, $relationshipId);
    }
}

