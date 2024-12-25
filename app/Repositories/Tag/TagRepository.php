<?php

namespace App\Repositories\Tag;

use App\Models\Tags\Tag;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\Tags\_IH_Tag_C;

class TagRepository
{
    protected Tag $model;

    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function getAll(): _IH_Tag_C|Collection|array
    {
        return $this->model->all();
    }

    public function findById($id): _IH_Tag_C|array|Tag
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $tag = $this->findById($id);
        $tag->update($data);
        return $tag;
    }

    public function delete($id): void
    {
        $tag = $this->findById($id);
        $tag->delete();
    }
}
