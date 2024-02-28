<?php

namespace App\Providers;

use App\Contracts\Models\Approvable;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Patient;
use App\Models\Stationary;
use App\Models\Ambulator;

use App\Policies\PatientPolicy;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        // Model::class => ModelPolicy::class,
        Patient::class => PatientPolicy::class,
    ];

    private function defineUserGates(): void
    {
        /**
         * Ստուգել, թե կատարված գրառումը (մոդելը) պատկանում է տվյալ օգտատիրոջը (user_id)
         */
        Gate::define("belongs-to-user", function (User $user, Model $model) {
            if ($user->id !== $model->user_id)
                throw new AuthorizationException(__("samples.not_belongs_to_user"), 403);
            // return Response::deny(__("samples.not_belongs_to_user"), 403);

            return true;
        });

        /**
         * Ստուգել, թե տվյալ օգտատերը կատարված գրառումը կարող է փոփոխել
         */
        Gate::define("update", function (User $user, Model $model) {
            if ($user->id !== $model->user_id)
                return false;

            return true;
        });

        /**
         * Ստուգել, թե արդյոք բաժնի վարիչը կարող է հաստատել գրառումը
         */
        Gate::define('user-can-approve', function (User $user, Approvable $model) {
            // If no approvement relation is found - most likely department has been open
            // when this model was created. Thus, no need to approve
            if (empty($model->approvement))
                return false;

            if ($user->hasRole("department_head") && $model->approvement->department_id === auth()->user()->department_id)
                return true;

            return Response::deny(__("samples.department-head-can-approve"), 403);

            // throw new AuthorizationException(__("samples.department-head-can-approve"));
        });

        Gate::define('is-department-head-or-registrar', function(User $user) {
            if($user->hasAnyRole(['department_head','department_registrar'])){
                return true;
            }
            throw new AuthorizationException(__("samples.not_belongs_to_user"), 403);
        });

        Gate::define('is-department-head', function(User $user) {
            if($user->hasRole('department_head')){
                return true;
            }
            throw new AuthorizationException(__("samples.not_belongs_to_user"), 403);
        });
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        //Register custom driver for User Eloquent to modify Auth query
        $this->app->auth->provider('custom', function ($app, array $config) {
            return new CustomEloquentUserProvider($app['hash'], $config['model']);
        });

        $this->registerPolicies();

        $this->defineUserGates();

        Gate::before(function ($user, $ability) {
            if ($user->isSuperAdmin() || $user->hasRole('director')) {
                return true;
            }
        });

        Gate::define('stationary-not-belongs-to-patient', function (User $user, Patient $patient, Stationary $stationary) {
            if ($patient->id !== $stationary->patient_id) {
                throw new AuthorizationException(__('stationary.stationary-not-belongs-to-patient'));
            }
            return true;
            // return $patient->id == $stationary->patient_id ? true : abort(403, __('stationary.stationary-not-belongs-to-patient'));
        });

        Gate::define('ambulator-not-belongs-to-patient', function (User $user, Patient $patient, Ambulator $ambulator) {
            if ($patient->id !== $ambulator->patient_id) {
                throw new AuthorizationException(__('ambulator.ambulator-not-belongs-to-patient'));
            }
            return true;
            // return $patient->id == $ambulator->patient_id ? true : abort(403, __('ambulator.ambulator-not-belongs-to-patient'));
        });

        //
    }
}
