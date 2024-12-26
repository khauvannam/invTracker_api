<?php

namespace App\Repositories\Item;

use App\Models\Items\Item;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\Items\_IH_Item_C;

class ItemRepository
{
    public function getAll(): Collection|_IH_Item_C|array
    {
        return Item::all();
    }

    public function findById(int $id): _IH_Item_C|Item|array|null
    {
        return Item::find($id);
    }

    public function create(array $data)
    {
        return Item::create($data);
    }

    public function update(int $id, array $data): _IH_Item_C|Item|array
    {
        $item = Item::findOrFail($id);
        $item->update($data);
        return $item;
    }

    public function delete(int $id): true
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return true;
    }
}
