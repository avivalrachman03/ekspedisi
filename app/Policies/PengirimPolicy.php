<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Pengirim;
use App\Models\User;

class PengirimPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // return $user->checkPermissionTo('view-any Pengirim');
        return $user->hasRole(['Admin', 'Karyawan']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pengirim $pengirim): bool
    {
        // return $user->checkPermissionTo('view Pengirim');
        return $user->hasRole(['Admin', 'Karyawan']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // return $user->checkPermissionTo('create Pengirim');
        return $user->hasRole(['Admin', 'Karyawan']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pengirim $pengirim): bool
    {
        // return $user->checkPermissionTo('update Pengirim');
        return $user->hasRole(['Admin', 'Karyawan']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pengirim $pengirim): bool
    {
        // return $user->checkPermissionTo('delete Pengirim');
        return $user->hasRole(['Admin', 'Karyawan']);
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        // return $user->checkPermissionTo('delete-any Pengirim');
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pengirim $pengirim): bool
    {
        return $user->checkPermissionTo('restore Pengirim');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any Pengirim');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, Pengirim $pengirim): bool
    {
        return $user->checkPermissionTo('replicate Pengirim');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder Pengirim');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pengirim $pengirim): bool
    {
        return $user->checkPermissionTo('force-delete Pengirim');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any Pengirim');
    }
}
