<?php
namespace App\Services;

use App\Repositories\TagRepository;

class TagService
{
    protected TagRepository $repository;

    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTags()
    {
        return $this->repository->getAll();
    }

    public function getTagById($id)
    {
        return $this->repository->findById($id);
    }

    public function createTag(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateTag($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteTag($id)
    {
        return $this->repository->delete($id);
    }
}