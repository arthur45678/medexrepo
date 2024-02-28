<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\Referral;
use App\Models\User;

class DepartmentReferralReceivedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $receiver;
    private $referral;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $receiver, Referral $referral)
    {
        $this->receiver = $receiver;
        $this->referral = $referral;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.Department.' . $this->receiver->department_id);
    }

    public function broadcastWith(): array
    {
        $this->referral->loadMissing(["sender", "sender.department"]);

        return [
            "referral" => $this->referral
        ];
    }
}
