<?php

namespace App\Services;

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
}
