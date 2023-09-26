<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pembelian;
use Illuminate\Auth\Access\HandlesAuthorization;

class PembelianPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the pembelian can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list pembelians');
    }

    /**
     * Determine whether the pembelian can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pembelian  $model
     * @return mixed
     */
    public function view(User $user, Pembelian $model)
    {
        return $user->hasPermissionTo('view pembelians');
    }

    /**
     * Determine whether the pembelian can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create pembelians');
    }

    /**
     * Determine whether the pembelian can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pembelian  $model
     * @return mixed
     */
    public function update(User $user, Pembelian $model)
    {
        return $user->hasPermissionTo('update pembelians');
    }

    /**
     * Determine whether the pembelian can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pembelian  $model
     * @return mixed
     */
    public function delete(User $user, Pembelian $model)
    {
        return $user->hasPermissionTo('delete pembelians');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pembelian  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete pembelians');
    }

    /**
     * Determine whether the pembelian can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pembelian  $model
     * @return mixed
     */
    public function restore(User $user, Pembelian $model)
    {
        return false;
    }

    /**
     * Determine whether the pembelian can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pembelian  $model
     * @return mixed
     */
    public function forceDelete(User $user, Pembelian $model)
    {
        return false;
    }
}
