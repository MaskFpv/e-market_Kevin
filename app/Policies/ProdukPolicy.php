<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Produk;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProdukPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the produk can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list produks');
    }

    /**
     * Determine whether the produk can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Produk  $model
     * @return mixed
     */
    public function view(User $user, Produk $model)
    {
        return $user->hasPermissionTo('view produks');
    }

    /**
     * Determine whether the produk can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create produks');
    }

    /**
     * Determine whether the produk can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Produk  $model
     * @return mixed
     */
    public function update(User $user, Produk $model)
    {
        return $user->hasPermissionTo('update produks');
    }

    /**
     * Determine whether the produk can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Produk  $model
     * @return mixed
     */
    public function delete(User $user, Produk $model)
    {
        return $user->hasPermissionTo('delete produks');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Produk  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete produks');
    }

    /**
     * Determine whether the produk can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Produk  $model
     * @return mixed
     */
    public function restore(User $user, Produk $model)
    {
        return false;
    }

    /**
     * Determine whether the produk can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Produk  $model
     * @return mixed
     */
    public function forceDelete(User $user, Produk $model)
    {
        return false;
    }
}
