<?php

namespace App\Services\Field;

use App\Repositories\Field\CustomFieldRepository;

class CustomFieldService
{
    protected $customFieldRepository;

    public function __construct(CustomFieldRepository $customFieldRepository)
    {
        $this->customFieldRepository = $customFieldRepository;
    }

    public function getAll()
    {
        return $this->customFieldRepository->all();
    }

    public function create(array $data)
    {
        return $this->customFieldRepository->create($data);
    }

    public function getById($id)
    {
        return $this->customFieldRepository->find($id);
    }

    public function update($id, array $data)
    {
        return $this->customFieldRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->customFieldRepository->delete($id);
    }
}

