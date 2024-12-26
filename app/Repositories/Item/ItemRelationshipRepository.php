<?php

namespace App\Repositories\Item;

use App\Models\Items\ItemRelationship;

class ItemRelationshipRepository
{
    
    public function createItemRelationship($itemId, $data)
    {
        $relationship = new ItemRelationship();
        $relationship->item_id = $itemId;
        $relationship->tag_id = $data['tag_id'];
        $relationship->save();
        
        return $relationship;
    }

   
    public function getItemRelationshipsByItemId($itemId)
    {
        return ItemRelationship::where('item_id', $itemId)->get();
    }

   
    public function deleteItemRelationship($itemId, $relationshipId)
    {
        $relationship = ItemRelationship::where('item_id', $itemId)->findOrFail($relationshipId);
        $relationship->delete();
    }
}

