<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TampungBayar;
use Illuminate\Auth\Access\HandlesAuthorization;

class TampungBayarPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the tampungBayar can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list tampungbayars');
    }

    /**
     * Determine whether the tampungBayar can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TampungBayar  $model
     * @return mixed
     */
    public function view(User $user, TampungBayar $model)
    {
        return $user->hasPermissionTo('view tampungbayars');
    }

    /**
     * Determine whether the tampungBayar can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create tampungbayars');
    }

    /**
     * Determine whether the tampungBayar can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TampungBayar  $model
     * @return mixed
     */
    public function update(User $user, TampungBayar $model)
    {
        return $user->hasPermissionTo('update tampungbayars');
    }

    /**
     * Determine whether the tampungBayar can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TampungBayar  $model
     * @return mixed
     */
    public function delete(User $user, TampungBayar $model)
    {
        return $user->hasPermissionTo('delete tampungbayars');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TampungBayar  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete tampungbayars');
    }

    /**
     * Determine whether the tampungBayar can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TampungBayar  $model
     * @return mixed
     */
    public function restore(User $user, TampungBayar $model)
    {
        return false;
    }

    /**
     * Determine whether the tampungBayar can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TampungBayar  $model
     * @return mixed
     */
    public function forceDelete(User $user, TampungBayar $model)
    {
        return false;
    }
}
