<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DetailTransaksi;
use Illuminate\Auth\Access\HandlesAuthorization;

class DetailTransaksiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the detailTransaksi can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list detailtransaksis');
    }

    /**
     * Determine whether the detailTransaksi can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailTransaksi  $model
     * @return mixed
     */
    public function view(User $user, DetailTransaksi $model)
    {
        return $user->hasPermissionTo('view detailtransaksis');
    }

    /**
     * Determine whether the detailTransaksi can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create detailtransaksis');
    }

    /**
     * Determine whether the detailTransaksi can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailTransaksi  $model
     * @return mixed
     */
    public function update(User $user, DetailTransaksi $model)
    {
        return $user->hasPermissionTo('update detailtransaksis');
    }

    /**
     * Determine whether the detailTransaksi can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailTransaksi  $model
     * @return mixed
     */
    public function delete(User $user, DetailTransaksi $model)
    {
        return $user->hasPermissionTo('delete detailtransaksis');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailTransaksi  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete detailtransaksis');
    }

    /**
     * Determine whether the detailTransaksi can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailTransaksi  $model
     * @return mixed
     */
    public function restore(User $user, DetailTransaksi $model)
    {
        return false;
    }

    /**
     * Determine whether the detailTransaksi can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailTransaksi  $model
     * @return mixed
     */
    public function forceDelete(User $user, DetailTransaksi $model)
    {
        return false;
    }
}
