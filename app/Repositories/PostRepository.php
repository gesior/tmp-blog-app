<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostRepository implements PostRepositoryInterface
{
    private Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function findAll(): Collection
    {
        return $this->post::all();
    }

    public function paginate(int $itemsPerPage = 10)
    {
        return $this->post::paginate($itemsPerPage);
    }

    public function find($userId)
    {
        return $this->post::findOrFail($userId);
    }

    public function create(array $data)
    {
        return $this->post::create($data);
    }

    public function update($userId, array $data)
    {
        return $this->post::whereId($userId)->update($data);
    }

    public function delete($userId): void
    {
        $this->post::destroy($userId);
    }
}
