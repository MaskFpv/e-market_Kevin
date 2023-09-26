<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DetailTransaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class DetailTransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the detailTransaction can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list detailtransactions');
    }

    /**
     * Determine whether the detailTransaction can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailTransaction  $model
     * @return mixed
     */
    public function view(User $user, DetailTransaction $model)
    {
        return $user->hasPermissionTo('view detailtransactions');
    }

    /**
     * Determine whether the detailTransaction can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create detailtransactions');
    }

    /**
     * Determine whether the detailTransaction can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailTransaction  $model
     * @return mixed
     */
    public function update(User $user, DetailTransaction $model)
    {
        return $user->hasPermissionTo('update detailtransactions');
    }

    /**
     * Determine whether the detailTransaction can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailTransaction  $model
     * @return mixed
     */
    public function delete(User $user, DetailTransaction $model)
    {
        return $user->hasPermissionTo('delete detailtransactions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailTransaction  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete detailtransactions');
    }

    /**
     * Determine whether the detailTransaction can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailTransaction  $model
     * @return mixed
     */
    public function restore(User $user, DetailTransaction $model)
    {
        return false;
    }

    /**
     * Determine whether the detailTransaction can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DetailTransaction  $model
     * @return mixed
     */
    public function forceDelete(User $user, DetailTransaction $model)
    {
        return false;
    }
}
