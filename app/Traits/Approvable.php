<?php

namespace App\Traits;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Models\Approvement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\User;

use Illuminate\Support\Facades\Log;

trait Approvable
{
    /**
     * Boot the main elements
     *
     * @return void
     */
    public static function bootApprovable(): void
    {
        if (!auth()->user()) // auth()->user()->... throws error in seeders - if no one is logged in, just skip this function
            return;

        static::created(function (ApprovableContract $model) {
            if (!auth()->user()->department->closed_from_inside)
                return false;

            $model->approvement()->create([
                "status" => 0, //Pending
                "department_id" => auth()->user()->department_id
            ]);
        });

        static::updated(function (ApprovableContract $model) {
            // dd("upadted");
            if (!auth()->user()->department->closed_from_inside)
                return false;

            $approvement = $model->approvement()->firstOrNew([
                "approvable_id" => $model->id,
                "approvable_type" => get_class($model)
            ]);

            $approvement->fill([
                "status" => 0,
                "department_id" => auth()->user()->department_id,
            ])->save();
        });

        static::deleted(function(ApprovableContract $model) {

	        if (!auth()->user()->department->closed_from_inside)
                return false;

            $model->approvement()->delete();
	    });
    }

    /**
     * Filter approvables based on status and the roles/permissions of authenticated user
     *
     * @return Illuminate\Database\Eloquent\Builder;
     */
    public function scopeOnlyApproved(Builder $builder, $user_id = null): Builder
    {
        $auth_user = User::find($user_id) ?? auth()->user();
        if ($auth_user->hasRole("super_admin")) //&& auth()->user()->department_id === $this->user->department_id)
            return $builder->with("approvement");

        return $builder->with("approvement")->whereDoesntHave('approvement', function (Builder $q) {
            $q->where("status", false);
        })->orWhereHas("user", function (Builder $q)  use ($auth_user) {
            $q->where("id", $auth_user->id);
        })->when($auth_user->hasRole("department_head"), function (Builder $q)  use ($auth_user) {
            $q->orWhereHas("approvement", function (Builder $q)  use ($auth_user) {
                $q->where("department_id", $auth_user->department_id);
            });
        });
    }

    /**
     * Return approvement status as a string (with translation)
     *
     * @return string
     */
    public function approvementStatus(): string
    {
        if (!$this->approvement)  // This assumes that the "approvement" relation was eager-loaded before hand. Otherwise wont work properly
            return "";

        return $this->approvement->status ? "Հաստատված" : "Սպասման մեջ";
    }


    /**
     * Return boll or null
     *
     * @return bool|null
     */
    public function approvementStatusBoolean()
    {
        if (empty($this->approvement)) // This assumes that the "approvement" relation was eager-loaded before hand. Otherwise wont work properly
            return null;

        return $this->approvement->status ? true : false;
    }
    /**
     * Relation to the approvements polymorphic table
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function approvement(): MorphOne
    {
        return $this->morphOne("App\Models\Approvement", "approvable");
    }
}
