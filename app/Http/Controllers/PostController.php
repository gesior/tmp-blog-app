<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
        $this->authorizeResource(Post::class, 'post', ['except' => ['index', 'show']]);
    }

    public function index(): JsonResponse
    {
        return response()->json($this->postRepository->paginate());
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;

        return response()->json($this->postRepository->create($data));
    }

    public function show(Post $post): JsonResponse
    {
        return response()->json($post);
    }

    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;

        return response()->json($this->postRepository->update($post->id, $data));
    }

    public function destroy(Post $post): JsonResponse
    {
        return response()->json($this->postRepository->delete($post->id));
    }
}
