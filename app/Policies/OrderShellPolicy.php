<?php

namespace App\Policies;

use App\Models\User;
use App\Models\OrderShell;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderShellPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the orderShell can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list ordershells');
    }

    /**
     * Determine whether the orderShell can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OrderShell  $model
     * @return mixed
     */
    public function view(User $user, OrderShell $model)
    {
        return $user->hasPermissionTo('view ordershells');
    }

    /**
     * Determine whether the orderShell can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create ordershells');
    }

    /**
     * Determine whether the orderShell can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OrderShell  $model
     * @return mixed
     */
    public function update(User $user, OrderShell $model)
    {
        return $user->hasPermissionTo('update ordershells');
    }

    /**
     * Determine whether the orderShell can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OrderShell  $model
     * @return mixed
     */
    public function delete(User $user, OrderShell $model)
    {
        return $user->hasPermissionTo('delete ordershells');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OrderShell  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete ordershells');
    }

    /**
     * Determine whether the orderShell can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OrderShell  $model
     * @return mixed
     */
    public function restore(User $user, OrderShell $model)
    {
        return false;
    }

    /**
     * Determine whether the orderShell can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OrderShell  $model
     * @return mixed
     */
    public function forceDelete(User $user, OrderShell $model)
    {
        return false;
    }
}
