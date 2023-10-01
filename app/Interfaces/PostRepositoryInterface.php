<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface
{
    public function findAll(): Collection;

    public function paginate(int $itemsPerPage);

    public function find($userId);

    public function create(array $data);

    public function update($userId, array $data);

    public function delete($userId);
}
