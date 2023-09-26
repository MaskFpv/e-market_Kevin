<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pemasok;
use Illuminate\Auth\Access\HandlesAuthorization;

class PemasokPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the pemasok can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list pemasoks');
    }

    /**
     * Determine whether the pemasok can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pemasok  $model
     * @return mixed
     */
    public function view(User $user, Pemasok $model)
    {
        return $user->hasPermissionTo('view pemasoks');
    }

    /**
     * Determine whether the pemasok can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create pemasoks');
    }

    /**
     * Determine whether the pemasok can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pemasok  $model
     * @return mixed
     */
    public function update(User $user, Pemasok $model)
    {
        return $user->hasPermissionTo('update pemasoks');
    }

    /**
     * Determine whether the pemasok can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pemasok  $model
     * @return mixed
     */
    public function delete(User $user, Pemasok $model)
    {
        return $user->hasPermissionTo('delete pemasoks');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pemasok  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete pemasoks');
    }

    /**
     * Determine whether the pemasok can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pemasok  $model
     * @return mixed
     */
    public function restore(User $user, Pemasok $model)
    {
        return false;
    }

    /**
     * Determine whether the pemasok can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pemasok  $model
     * @return mixed
     */
    public function forceDelete(User $user, Pemasok $model)
    {
        return false;
    }
}
