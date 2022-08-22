<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ChangeOwnershipAgent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $user;
    public $incidentId;
    public $title;
    public $incident;
    public $name;

    public function __construct($incident)
    {
        //dd($incident->assigned->name);
        $this->user  = $incident->requesting_user;
        //$this->message = $message;
        $this->incidentId = $incident->id;
        $this->title = $incident->title;
        $this->name = $incident->assigned->name;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('changeownershipagent.'. $this->user->id);
    }
}
