<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Regency;
use App\Models\User;

class RegencyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // return $user->checkPermissionTo('view-any Regency');
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Regency $regency): bool
    {
        // return $user->checkPermissionTo('view Regency');
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // return $user->checkPermissionTo('create Regency');
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Regency $regency): bool
    {
        // return $user->checkPermissionTo('update Regency');
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Regency $regency): bool
    {
        // return $user->checkPermissionTo('delete Regency');
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        // return $user->checkPermissionTo('delete-any Regency');
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Regency $regency): bool
    {
        return $user->checkPermissionTo('restore Regency');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any Regency');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, Regency $regency): bool
    {
        return $user->checkPermissionTo('replicate Regency');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder Regency');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Regency $regency): bool
    {
        return $user->checkPermissionTo('force-delete Regency');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any Regency');
    }
}
