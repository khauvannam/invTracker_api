<?php

namespace App\Repositories;

use App\Models\Tags\Tag;
use Illuminate\Database\Eloquent\Collection;

class TagRepository
{
    protected Tag $model;

    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function findById($id): Tag
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data): Tag
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
