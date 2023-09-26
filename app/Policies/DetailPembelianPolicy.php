<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DetailPembelian;
use Illuminate\Auth\Access\HandlesAuthorization;

class DetailPembelianPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the detailPembelian can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list detailpembelians');
    }

    /**
     * Determine whether the detailPembelian can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailPembelian  $model
     * @return mixed
     */
    public function view(User $user, DetailPembelian $model)
    {
        return $user->hasPermissionTo('view detailpembelians');
    }

    /**
     * Determine whether the detailPembelian can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create detailpembelians');
    }

    /**
     * Determine whether the detailPembelian can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailPembelian  $model
     * @return mixed
     */
    public function update(User $user, DetailPembelian $model)
    {
        return $user->hasPermissionTo('update detailpembelians');
    }

    /**
     * Determine whether the detailPembelian can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailPembelian  $model
     * @return mixed
     */
    public function delete(User $user, DetailPembelian $model)
    {
        return $user->hasPermissionTo('delete detailpembelians');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailPembelian  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete detailpembelians');
    }

    /**
     * Determine whether the detailPembelian can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailPembelian  $model
     * @return mixed
     */
    public function restore(User $user, DetailPembelian $model)
    {
        return false;
    }

    /**
     * Determine whether the detailPembelian can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailPembelian  $model
     * @return mixed
     */
    public function forceDelete(User $user, DetailPembelian $model)
    {
        return false;
    }
}
