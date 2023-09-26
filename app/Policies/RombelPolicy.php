<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Rombel;
use Illuminate\Auth\Access\HandlesAuthorization;

class RombelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the rombel can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list rombels');
    }

    /**
     * Determine whether the rombel can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Rombel  $model
     * @return mixed
     */
    public function view(User $user, Rombel $model)
    {
        return $user->hasPermissionTo('view rombels');
    }

    /**
     * Determine whether the rombel can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create rombels');
    }

    /**
     * Determine whether the rombel can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Rombel  $model
     * @return mixed
     */
    public function update(User $user, Rombel $model)
    {
        return $user->hasPermissionTo('update rombels');
    }

    /**
     * Determine whether the rombel can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Rombel  $model
     * @return mixed
     */
    public function delete(User $user, Rombel $model)
    {
        return $user->hasPermissionTo('delete rombels');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Rombel  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete rombels');
    }

    /**
     * Determine whether the rombel can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Rombel  $model
     * @return mixed
     */
    public function restore(User $user, Rombel $model)
    {
        return false;
    }

    /**
     * Determine whether the rombel can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Rombel  $model
     * @return mixed
     */
    public function forceDelete(User $user, Rombel $model)
    {
        return false;
    }
}
