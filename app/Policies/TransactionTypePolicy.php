<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TransactionType;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the transactionType can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list transactiontypes');
    }

    /**
     * Determine whether the transactionType can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TransactionType  $model
     * @return mixed
     */
    public function view(User $user, TransactionType $model)
    {
        return $user->hasPermissionTo('view transactiontypes');
    }

    /**
     * Determine whether the transactionType can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create transactiontypes');
    }

    /**
     * Determine whether the transactionType can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TransactionType  $model
     * @return mixed
     */
    public function update(User $user, TransactionType $model)
    {
        return $user->hasPermissionTo('update transactiontypes');
    }

    /**
     * Determine whether the transactionType can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TransactionType  $model
     * @return mixed
     */
    public function delete(User $user, TransactionType $model)
    {
        return $user->hasPermissionTo('delete transactiontypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TransactionType  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete transactiontypes');
    }

    /**
     * Determine whether the transactionType can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TransactionType  $model
     * @return mixed
     */
    public function restore(User $user, TransactionType $model)
    {
        return false;
    }

    /**
     * Determine whether the transactionType can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TransactionType  $model
     * @return mixed
     */
    public function forceDelete(User $user, TransactionType $model)
    {
        return false;
    }
}
