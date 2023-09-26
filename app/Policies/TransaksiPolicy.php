<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransaksiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the transaksi can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list transaksis');
    }

    /**
     * Determine whether the transaksi can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Transaksi  $model
     * @return mixed
     */
    public function view(User $user, Transaksi $model)
    {
        return $user->hasPermissionTo('view transaksis');
    }

    /**
     * Determine whether the transaksi can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create transaksis');
    }

    /**
     * Determine whether the transaksi can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Transaksi  $model
     * @return mixed
     */
    public function update(User $user, Transaksi $model)
    {
        return $user->hasPermissionTo('update transaksis');
    }

    /**
     * Determine whether the transaksi can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Transaksi  $model
     * @return mixed
     */
    public function delete(User $user, Transaksi $model)
    {
        return $user->hasPermissionTo('delete transaksis');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Transaksi  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete transaksis');
    }

    /**
     * Determine whether the transaksi can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Transaksi  $model
     * @return mixed
     */
    public function restore(User $user, Transaksi $model)
    {
        return false;
    }

    /**
     * Determine whether the transaksi can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Transaksi  $model
     * @return mixed
     */
    public function forceDelete(User $user, Transaksi $model)
    {
        return false;
    }
}
