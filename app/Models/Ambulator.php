<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;

class Ambulator extends Model
{
    use LogsActivity;

    protected static $logName = 'ambulator';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];


    protected $with = [
        'diagnoses',
        'attendances',
        'complaints',
        'complaints.user',
        'female_issues',
        'tumor_infos',
        'tumor_infos.user',
        'onset_and_developments',
        'onset_and_developments.user',
        'health_statuses'
    ];
    protected $approvableSections = [
        'diagnoses',
        'attendances',
        'complaints',
        'female_issues',
        'tumor_infos',
        'onset_and_developments',
        'health_statuses',
        'tnms'
    ];
    protected $fillable = [
        'number',
        'patient_id',
        'registration_date',
        'is_a_twin'
    ];
    public function getApprovableSections(): array
    {
        return $this->approvableSections;
    }

    public function loadAllRelationsForApprovement(): void
    {
        $allSectionsWithNestedRelations = $this->getApprovableSections();

        // foreach($allSectionsWithNestedRelations as $i => $relation){
        //     $relation
        // }

        foreach ($this->getApprovableSections() as $relatedSection) {
            $allSectionsWithNestedRelations[] = $relatedSection . ".user";
            $allSectionsWithNestedRelations[] = $relatedSection . ".approvement";
        }

        $this->loadMissing($allSectionsWithNestedRelations);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo('App\Models\Patient');
    }

    /**
     * Get the diagnoses for the ambulator.
     */
    public function diagnoses(): HasMany
    {
        return $this->hasMany('App\Models\Diagnosis');
    }

    public function preliminary_diagnosis() {
        return $this->diagnoses()->where('type', 'preliminary')->with('disease_item', 'user')->first();
    }

    public function final_diagnosis() {
        return $this->diagnoses()->where('type', 'final')->with('disease_item', 'user')->first();
    }

    public function previous_diagnoses() {
        return $this->diagnoses()->where([
            ['type', 'previous'],
            ['user_id', auth()->id()]
        ])->with('disease_item', 'user')->get();
    }

    /**
     * Get the attendances for the ambulator.
     */
    public function attendances(): HasMany
    {
        return $this->hasMany('App\Models\Attendance');
    }

    /**
     * Get the complaints for the ambulator.
     */
    public function complaints(): HasMany
    {
        return $this->hasMany('App\Models\Complaint');
    }

    /**
     * Get the female_issues for the ambulator.
     */
    // public function female_issues(): HasMany
    public function female_issues(): HasOne
    {
        // changed to hasOne on 25.09.2020 - speak with Arevik
        return $this->hasOne('App\Models\FemaleIssue');
    }


    /**
     * Get the onset_and_developments for the ambulator.
     */
    public function onset_and_developments(): HasMany
    {
        return $this->hasMany('App\Models\OnsetAndDevelopment');
    }

    /**
     * Get the onset_and_developments for the ambulator.
     */
    public function tumor_infos(): HasMany
    {
        return $this->hasMany('App\Models\TumorInfo');
    }

    /**
     * Get the health_statuses for the ambulator.
     */
    public function health_statuses(): HasMany
    {
        return $this->hasMany('App\Models\HealthStatus');
    }

    /**
     * Get all of the ambulator's tnms.
     */
    public function tnms()
    {
        return $this->morphMany('App\Models\Tnm', 'tnmable');
    }

}
