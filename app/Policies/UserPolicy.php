<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $loggedUser, User $user): bool {
        return $loggedUser->role === Role::Admin || $loggedUser->id === $user->id;
    }
}
