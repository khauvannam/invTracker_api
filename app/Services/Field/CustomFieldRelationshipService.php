<?php

namespace App\Services\Field;

use App\Repositories\Field\CustomFieldRelationshipRepository;

class CustomFieldRelationshipService
{
    protected $customFieldRelationshipRepository;

    public function __construct(CustomFieldRelationshipRepository $customFieldRelationshipRepository)
    {
        $this->customFieldRelationshipRepository = $customFieldRelationshipRepository;
    }

    public function createRelationship($customFieldId, array $data)
    {
        return $this->customFieldRelationshipRepository->createRelationship($customFieldId, $data);
    }

    public function getRelationships($customFieldId)
    {
        return $this->customFieldRelationshipRepository->getRelationshipsByCustomFieldId($customFieldId);
    }

    public function deleteRelationship($customFieldId, $relationshipId)
    {
        return $this->customFieldRelationshipRepository->deleteRelationship($customFieldId, $relationshipId);
    }
}

