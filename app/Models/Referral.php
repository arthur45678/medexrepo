<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Referral extends Model
{
    protected $fillable = [
        "patient_id",
        "patient_connection_id",
        "sender_id",
        "receiver_id",
        "department_id",
        "patient_id",
        "opened_at",
        "accepted_at",
        "finished_at"
    ];

    protected $appends = [
        "date_with_diff", "draw_referral_phase"
    ];

    /**
     * Date with translated difference from now
     *
     * @return string;
     */
    public function getDateWithDiffAttribute(): string
    {
        return  $this->created_at . " (" . Carbon::parse($this->created_at)->diffForHumans(now()) . ")";
    }

    /**
     * Relation to the user who has sent the referral
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo("App\Models\User", "sender_id", "id");
    }

    /**
     * Relation to the user who has received the referral
     * Can be NULL, because referral can be sent to the whole department
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo("App\Models\User", "receiver_id", "id");
    }

    /**
     * Relation to the department to which referral was sent
     * Can be NULL, because referral can be sent to an individual user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo("App\Models\Department");
    }

    /**
     * Relation to the specific row, which was created with currect referral
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient_connection(): BelongsTo
    {
        return $this->belongsTo("App\Models\PatientConnection");
    }

    /**
     * Relation to the services, todo-list of currect referral
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    # Հին սերվիսներն են, խառը
    public function services(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\ServiceList', 'referral_service', 'referral_id', 'service_list_id')
            ->withPivot('payment_type', 'comment')->withTimestamps();
    }

    /**
     * Relation to the referral_services,
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referral_services(): HasMany
    {
        return $this->hasMany('App\Models\ReferralService', 'referral_id', 'id');
    }


    /**
     * Relation to the patient, with whom was sent currect referral
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo('App\Models\Patient');
    }

    /**
     * Relation to the queue in department queueing
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function queue(): HasOne
    {
        return $this->hasOne('App\Models\Queue');
    }

    public function referral_phase(): string
    {
        $opened_at = $this->opened_at;
        $accepted_at = $this->accepted_at;
        $finished_at = $this->finished_at;

        if ($opened_at && !$accepted_at) return 'opened_at';
        if ($accepted_at && !$finished_at) return 'accepted_at';
        if ($finished_at) return 'finished_at';
        else return 'created_at';
    }


    public function draw_referral_phase(): string
    {
        if ($this->referral_phase() === 'opened_at') return '<span class="badge badge-danger bade-indicator"></span> o';
        if ($this->referral_phase() === 'accepted_at') return '<span class="badge badge-warning bade-indicator"></span> a';
        if ($this->referral_phase() === 'finished_at') return '<span class="badge badge-success bade-indicator"></span> f';
        return '<span class="badge badge-dark bade-indicator"></span> c';
    }

    public function getDrawReferralPhaseAttribute(): string
    {
        return  $this->draw_referral_phase();
    }
}
