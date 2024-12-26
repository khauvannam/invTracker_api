<?php

namespace App\Repositories\Field;

use App\Models\Field\CustomFieldRelationship;

class CustomFieldRelationshipRepository
{
    public function createRelationship($customFieldId, array $data)
    {
        $data['custom_field_id'] = $customFieldId;
        return CustomFieldRelationship::create($data);
    }

    public function getRelationshipsByCustomFieldId($customFieldId)
    {
        return CustomFieldRelationship::where('custom_field_id', $customFieldId)->get();
    }

    public function deleteRelationship($customFieldId, $relationshipId)
    {
        $relationship = CustomFieldRelationship::where('custom_field_id', $customFieldId)
            ->where('id', $relationshipId)
            ->firstOrFail();
        $relationship->delete();
    }
}
