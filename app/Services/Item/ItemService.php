<?php

namespace App\Services\Item;

use App\Models\Items\Item;

class ItemService
{
    
    public function getAllItems()
    {
        return Item::all();
    }

   
    public function getItemById(int $id)
    {
        return Item::find($id);
    }

    
    public function createItem(array $data)
    {
        return Item::create($data);
    }

   
    public function updateItem(int $id, array $data)
    {
        $item = Item::findOrFail($id);
        $item->update($data);
        return $item;
    }

   
    public function deleteItem(int $id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return true;
    }
}
