<?php

namespace App\Repositories;

use App\Models\Tags\Tag;

class TagRepository
{
    protected $model;

    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function getAll() 
    {
        return $this->model->all();
    }

    public function findById($id) 
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

    public function delete($id)
    {
        $tag = $this->findById($id);
        $tag->delete();
        return true;
    }
}
