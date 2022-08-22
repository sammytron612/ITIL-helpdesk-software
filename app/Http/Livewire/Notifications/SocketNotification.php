<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;
use App\Notifications\NewIncident;
use App\Notifications\UpdateIncident;
use Auth;
use Session;

class SocketNotification extends Component
{
    public $user;
    public $count;
    public $notifications;

    

    public function mount()
    {
    
        $this->user = Auth::user();
    }

    public function getListeners()
    {
        return ["echo-private:newcomment.{$this->user->id},NewComment" => 'newComment',
                
        ];
    }

    public function render()
    {
        
        if(session::has('notifications'))
        {
            
            $this->count = count(session('notifications'));
            $this->notifications = session('notifications');
        }
        else {
            
            $this->count = 0;
            $this->notifications = [];
        }

        return view('livewire.notifications.socket-notification', ['notifications' => $this->notifications]);
    }

    public function newIncident()
    {
        
        $this->count ++;
        $this->user->notify(new NewIncident($this->user));
    }

    public function newComment($data)
    {
        dd($data);
        $array = ['id' => 1,
                'message' => 'new incident'];

        session()->push('notifications',$array);
        
        $this->count ++;
        $this->user->notify(new UpdateIncident($this->user));

    }

    
}
