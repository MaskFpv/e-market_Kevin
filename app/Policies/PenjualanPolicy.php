<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Penjualan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PenjualanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the penjualan can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list penjualans');
    }

    /**
     * Determine whether the penjualan can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Penjualan  $model
     * @return mixed
     */
    public function view(User $user, Penjualan $model)
    {
        return $user->hasPermissionTo('view penjualans');
    }

    /**
     * Determine whether the penjualan can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create penjualans');
    }

    /**
     * Determine whether the penjualan can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Penjualan  $model
     * @return mixed
     */
    public function update(User $user, Penjualan $model)
    {
        return $user->hasPermissionTo('update penjualans');
    }

    /**
     * Determine whether the penjualan can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Penjualan  $model
     * @return mixed
     */
    public function delete(User $user, Penjualan $model)
    {
        return $user->hasPermissionTo('delete penjualans');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Penjualan  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete penjualans');
    }

    /**
     * Determine whether the penjualan can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Penjualan  $model
     * @return mixed
     */
    public function restore(User $user, Penjualan $model)
    {
        return false;
    }

    /**
     * Determine whether the penjualan can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Penjualan  $model
     * @return mixed
     */
    public function forceDelete(User $user, Penjualan $model)
    {
        return false;
    }
}
