<?php

namespace App\Events;

use App\Models\Referral;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReferralReceivedEvent implements ShouldBroadcast
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
        return new PrivateChannel('App.User.' . $this->receiver->id);
    }

    public function broadcastWith(): array
    {
        $this->referral->loadMissing(["sender", "sender.department"]);

        return [
            "referral" => $this->referral
        ];
    }
}
