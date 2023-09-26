<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DetailPenjualan;
use Illuminate\Auth\Access\HandlesAuthorization;

class DetailPenjualanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the detailPenjualan can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list detailpenjualans');
    }

    /**
     * Determine whether the detailPenjualan can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailPenjualan  $model
     * @return mixed
     */
    public function view(User $user, DetailPenjualan $model)
    {
        return $user->hasPermissionTo('view detailpenjualans');
    }

    /**
     * Determine whether the detailPenjualan can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create detailpenjualans');
    }

    /**
     * Determine whether the detailPenjualan can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailPenjualan  $model
     * @return mixed
     */
    public function update(User $user, DetailPenjualan $model)
    {
        return $user->hasPermissionTo('update detailpenjualans');
    }

    /**
     * Determine whether the detailPenjualan can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailPenjualan  $model
     * @return mixed
     */
    public function delete(User $user, DetailPenjualan $model)
    {
        return $user->hasPermissionTo('delete detailpenjualans');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailPenjualan  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete detailpenjualans');
    }

    /**
     * Determine whether the detailPenjualan can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailPenjualan  $model
     * @return mixed
     */
    public function restore(User $user, DetailPenjualan $model)
    {
        return false;
    }

    /**
     * Determine whether the detailPenjualan can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailPenjualan  $model
     * @return mixed
     */
    public function forceDelete(User $user, DetailPenjualan $model)
    {
        return false;
    }
}
