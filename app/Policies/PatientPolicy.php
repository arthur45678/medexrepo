<?php

namespace App\Policies;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\AuthorizationException;

class PatientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        // PatientsController@index
        // dump("viewAny-patient {$user->username}");
        if(! $user->can('view patients')){
            throw new AuthorizationException( __('authorization.user.can-not-view-patients'));
        }
        return true;
        // return ($user->can('view patients')) ?: abort(403, __('authorization.user.can-not-view-patients'));
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Patient  $patient
     * @return mixed
     */
    public function view(User $user, Patient $patient)
    {
        // dump('view-patient');
        if(! $user->can('view patients')){
            throw new AuthorizationException( __('authorization.user.can-not-view-patients'));
        }
        return true;
    }


    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // dump('create-patient');
        if(!$user->can('create patients')){
            throw new AuthorizationException( __('authorization.user.can-not-create-patients'));
        }
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Patient  $patient
     * @return mixed
     */
    public function update(User $user, Patient $patient)
    {
        // dump('update-patient');
        // return true;
        if(! $user->can('update patients')) {
            throw new AuthorizationException( __('authorization.user.can-not-update-patients'));
        }
        return true;

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Patient  $patient
     * @return mixed
     */
    public function delete(User $user, Patient $patient)
    {
        // dump('delete-patient');
        if(!$user->can('delete patients')) {
            throw new AuthorizationException( __('authorization.user.can-not-delete-patients'), 403);
        }
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Patient  $patient
     * @return mixed
     */
    public function restore(User $user, Patient $patient)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Patient  $patient
     * @return mixed
     */
    public function forceDelete(User $user, Patient $patient)
    {
        //
    }
}
