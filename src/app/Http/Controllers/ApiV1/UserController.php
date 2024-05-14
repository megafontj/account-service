<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FollowAndUnfollowRequest;
use App\Http\Requests\UpdateOrCreateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use App\Support\QuerySearch\SearchQuery;
use App\Support\Requests\SearchRequest;
use App\Support\Resources\EmptyResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function __construct(readonly private UserService $userService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request, SearchQuery $filter)
    {
        return User::filter($filter)
            ->withCount(['followers', 'following'])
            ->cursorPaginate(20);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpdateOrCreateUserRequest $request): UserResource
    {
        return new UserResource($this->userService->upsert($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrCreateUserRequest $request, User $user): UserResource
    {
        return new UserResource($this->userService->upsert($request->validated(), $user));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): EmptyResource
    {
        $this->userService->destroy($user);
        return new EmptyResource();
    }

    public function followers(int $id): AnonymousResourceCollection
    {
        return UserResource::collection($this->userService->getFollowers($id));
    }

    public function following(int $id): AnonymousResourceCollection
    {
        return UserResource::collection($this->userService->getFollowing($id));
    }

    public function followUser(int $id, FollowAndUnfollowRequest $request): EmptyResource
    {
        $this->userService->followUser($id, $request->getUserId());

        return new EmptyResource();
    }

    public function unfollowUser(int $id, FollowAndUnfollowRequest $request): EmptyResource
    {
        $this->userService->unfollowUser($id, $request->getUserId());

        return new EmptyResource();
    }
}
