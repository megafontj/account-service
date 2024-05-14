<?php

namespace App\Services;

use App\Jobs\UserFollowed;
use App\Models\User;

class UserService
{
    public function upsert(array $data, ?User $user = null): User
    {
        return User::updateOrCreate(
            ['id' => $user?->id],
            $data
        );
    }

    public function destroy(User $user)
    {
        $user->delete();
    }

    public function getFollowers(int $userId)
    {
        return User::query()
            ->findOrFail($userId)
            ->followers()
            ->get();
    }

    public function getFollowing(int $userId)
    {
        return User::query()
            ->findOrFail($userId)
            ->following()
            ->get();
    }

    public function followUser(int $follingId, int $followerId)
    {
        if ($followerId === $follingId) {
            return;
        }
        /** @var User $user */
        $user = User::findOrFail($follingId);

        $user->followers()->attach($followerId);

        UserFollowed::dispatch($follingId, $followerId)->onQueue('followers');
    }

    public function unfollowUser(int $followerId, int $followingId)
    {
        /** @var User $user */
        $user = User::findOrFail($followingId);

        $user->followers()->detach($followerId);
    }
}
