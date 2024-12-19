<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(array $data): User
    {
        return $this->userRepository->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->userRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->userRepository->delete($id);
    }

    public function find(int $id): User
    {
        return $this->userRepository->find($id);
    }

    public function all(): array
    {
        return $this->userRepository->all();
    }

}
