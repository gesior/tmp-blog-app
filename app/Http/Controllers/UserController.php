<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->authorizeResource(User::class, 'user', ['except' => ['store']]);
    }

    public function index(): JsonResponse
    {
        return response()->json($this->userRepository->paginate());
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $userData = $request->validated();
        $userData['password'] = bcrypt($userData['password']);

        $user = $this->userRepository->create($userData);

        UserCreated::dispatch($user);

        return response()->json($user);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $userData = $request->validated();
        if (isset($userData['password'])) {
            $userData['password'] = bcrypt($userData['password']);
        }

        return response()->json($this->userRepository->update($user->id, $userData));
    }

    public function destroy(User $user): JsonResponse
    {
        return response()->json($this->userRepository->delete($user->id));
    }

    public function roles(): JsonResponse
    {
        return response()->json(User::getRoles());
    }
}
