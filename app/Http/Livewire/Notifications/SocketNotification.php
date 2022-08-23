<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;
use App\Notifications\ChangeOwnership;
use App\Notifications\NewComment;
use Auth;
use Session;

class SocketNotification extends Component
{
    public $user;
    public $count = 0;
    public $notifications = [];



    public function mount()
    {

        $this->user = Auth::user();
    }

    public function getListeners()
    {
        return ["echo-private:incidentevent.{$this->user->id},IncidentEvent" => 'incidentEvent'];
    }

    public function render()
    {

        if(session::has('notifications'))
        {

            $this->count = count(session('notifications'));
            $this->notifications = array_reverse(session('notifications'));
        }


        return view('livewire.notifications.socket-notification', ['notifications' => $this->notifications]);
    }

    public function newIncident($data)
    {


    }


    public function gotoIncident($incidentId,$id)
    {

        $this->removeNotification($id);

        return redirect()->to('/ticket/' . $incidentId . '/edit');
    }

    public function removeNotification($id)
    {

        foreach($this->notifications as $key => $value)
        {
            if($value['id'] == $id)
            {
                //dd('match');
                unset($this->notifications[$key]);
            }
        }
        session()->put('notifications', $this->notifications);

        return;

    }

    public function incidentEvent($data)
    {

        $array = ['id' => $this->count,
                'incidentId' => $data['incidentId'],
                'message' => $data['message']
            ];

        session()->push('notifications',$array);

        $this->user->notify(new ChangeOwnership($data));

    }



}
