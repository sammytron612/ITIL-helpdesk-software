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
    public $name;
    public $assigned_to;


    public function __construct($incident)
    {

        $this->user  = $incident->requestor;
        //$this->message = $message;
        $this->incidentId = $incident->id;
        $this->title = $incident->title;
        $this->name = $incident->assigned->name;
        $this->assigned_to = $incident->assigned_to;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return [
            new PrivateChannel('changeownershipagent.'. $this->user),
            new PrivateChannel('changeownershipagent.'. $this->assigned_to)
        ];
    }
}
