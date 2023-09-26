<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Purchase;
use Illuminate\Auth\Access\HandlesAuthorization;

class PurchasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the purchase can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list purchases');
    }

    /**
     * Determine whether the purchase can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Purchase  $model
     * @return mixed
     */
    public function view(User $user, Purchase $model)
    {
        return $user->hasPermissionTo('view purchases');
    }

    /**
     * Determine whether the purchase can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create purchases');
    }

    /**
     * Determine whether the purchase can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Purchase  $model
     * @return mixed
     */
    public function update(User $user, Purchase $model)
    {
        return $user->hasPermissionTo('update purchases');
    }

    /**
     * Determine whether the purchase can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Purchase  $model
     * @return mixed
     */
    public function delete(User $user, Purchase $model)
    {
        return $user->hasPermissionTo('delete purchases');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Purchase  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete purchases');
    }

    /**
     * Determine whether the purchase can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Purchase  $model
     * @return mixed
     */
    public function restore(User $user, Purchase $model)
    {
        return false;
    }

    /**
     * Determine whether the purchase can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Purchase  $model
     * @return mixed
     */
    public function forceDelete(User $user, Purchase $model)
    {
        return false;
    }
}
