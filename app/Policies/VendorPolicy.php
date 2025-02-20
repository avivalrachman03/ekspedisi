<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Vendor;
use App\Models\User;

class VendorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // return $user->checkPermissionTo('view-any Vendor');
        return $user->hasRole(['Admin', 'Karyawan']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Vendor $vendor): bool
    {
        return $user->checkPermissionTo('view Vendor');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // return $user->checkPermissionTo('create Vendor');
        return $user->hasRole(['Admin', 'Karyawan']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vendor $vendor): bool
    {
        // return $user->checkPermissionTo('update Vendor');
        return $user->hasRole(['Admin', 'Karyawan']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vendor $vendor): bool
    {
        // return $user->checkPermissionTo('delete Vendor');
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any Vendor');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Vendor $vendor): bool
    {
        return $user->checkPermissionTo('restore Vendor');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any Vendor');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, Vendor $vendor): bool
    {
        return $user->checkPermissionTo('replicate Vendor');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder Vendor');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Vendor $vendor): bool
    {
        return $user->checkPermissionTo('force-delete Vendor');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any Vendor');
    }
}
