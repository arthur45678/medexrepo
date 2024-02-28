<?php

namespace App\Events;

use App\Models\NonMedicalReferral;
use App\Models\Referral;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NonMedicalReferralAcceptedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $referral;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, NonMedicalReferral $referral)
    {
        $this->user = $user;
        $this->referral = $referral;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('referrals-channel');
    }

    // public function broadcastAs(): string
    // {
    //     return "referral_accepted";
    // }

    public function broadcastWith(): array
    {
        return [
            "name" => "Ուղեգիր",
            "sender" => $this->user->full_name,
            "comment" => $this->referral->comment
        ];
    }
}
