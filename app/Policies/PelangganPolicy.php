<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PelangganPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the pelanggan can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list pelanggans');
    }

    /**
     * Determine whether the pelanggan can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pelanggan  $model
     * @return mixed
     */
    public function view(User $user, Pelanggan $model)
    {
        return $user->hasPermissionTo('view pelanggans');
    }

    /**
     * Determine whether the pelanggan can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create pelanggans');
    }

    /**
     * Determine whether the pelanggan can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pelanggan  $model
     * @return mixed
     */
    public function update(User $user, Pelanggan $model)
    {
        return $user->hasPermissionTo('update pelanggans');
    }

    /**
     * Determine whether the pelanggan can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pelanggan  $model
     * @return mixed
     */
    public function delete(User $user, Pelanggan $model)
    {
        return $user->hasPermissionTo('delete pelanggans');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pelanggan  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete pelanggans');
    }

    /**
     * Determine whether the pelanggan can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pelanggan  $model
     * @return mixed
     */
    public function restore(User $user, Pelanggan $model)
    {
        return false;
    }

    /**
     * Determine whether the pelanggan can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pelanggan  $model
     * @return mixed
     */
    public function forceDelete(User $user, Pelanggan $model)
    {
        return false;
    }
}
