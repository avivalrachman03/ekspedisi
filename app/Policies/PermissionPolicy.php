<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        // return $user->hasRole('Admin');
    }
    public function create(User $user)
    {
        // return $user->hasRole('Admin');
    }
    public function update(User $user)
    {
        // return $user->hasRole('Admin');
    }
    public function view(User $user)
    {
        // return $user->hasRole('Admin');
    }
    public function delete(User $user)
    {
        // return $user->hasRole('Admin');
    }
    public function deleteAny(User $user)
    {
        // return $user->hasRole('Admin');
    }
}

