<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;
use App\Notifications\NewIncident;
use App\Notifications\UpdateIncident;
use Auth;

class SocketNotification extends Component
{
    public $user;
    public $count = 0;

    public function mount()
    {
        $this->user = Auth::user();
    }
    

    public function getListeners()
    {
        return ["echo-private:incidentnew.{$this->user->id},NewIncident" => 'newIncident',
                "echo-private:incidentupdate.{$this->user->id},UpdateIncident" => 'updateIncident'
        ];
    }

    public function render()
    {
        return view('livewire.notifications.socket-notification');
    }

    public function newIncident()
    {
        $this->count ++;
        $this->user->notify(new NewIncident($this->user));

    }

    public function updateIncident()
    {
        $this->count ++;
        $this->user->notify(new UpdateIncident($this->user));

    }
}
