<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Auth;
use App\Models\User;


class NewComment implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $user;
    public $message;
    public $incidentId;

    public function __construct(User $user, $message, $incidentId)
    {
        $this->user  = $user;
        $this->message = $message;
        $this->incidentId = $incidentId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    
    

    public function broadcastOn()
    {
        
        return 
        [
            new PrivateChannel('newcomment.'. $this->user->id),
        ];
    }
}
