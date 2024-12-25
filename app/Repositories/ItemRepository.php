<?php

namespace App\Repositories;

use App\Models\Items\Item;

class ItemRepository
{
    
    public function getAll()
    {
        return Item::all();
    }

    
    public function findById(int $id)
    {
        return Item::find($id);
    }

    
    public function create(array $data)
    {
        return Item::create($data);
    }

    
    public function update(int $id, array $data)
    {
        $item = Item::findOrFail($id);
        $item->update($data);
        return $item;
    }

   
    public function delete(int $id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return true;
    }
}
