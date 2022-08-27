<?php

namespace App\Http\Livewire\ViewTicket;

use Livewire\Component;
use App\Models\User;
use App\Models\agent_group;
use App\Models\incidents;
use App\Events\ChangeOwnershipAgent;

use App\Service\UpdateTicket;

class Modal extends Component
{
    protected $listeners = ['openModal'];
    public $viewModal = false;

    public $searchTerm;
    public $incident;


    public function render()
    {

        $userResults = [];
        $groupResults = [];

        if(strlen($this->searchTerm > 2))
        {
            $userResults = User::select('id','name')->where('role','agent')->where('name', 'like', '%' . $this->searchTerm . '%')->get();
            $groupResults = agent_group::where('name', 'like', '%' . $this->searchTerm . '%')->get();
        }


        return view('livewire.view-ticket.modal',(['userResults' => $userResults, 'groupResults' => $groupResults]));
    }

    public function assignToUser($user_id)
    {

        $ticket = new UpdateTicket;
        $desc = $ticket->assign_to($this->incident, $user_id);

        $this->viewModal = false;
        $this->reset('searchTerm');
        $this->emitTo('view-ticket.status-button','renderStatus');

        $this->emit('updateAssigned', $desc);
        $this->dispatchBrowserEvent('update_success');



    }

    public function assignToGroup($group_id)
    {
        $ticket = new UpdateTicket;
        $desc = $ticket->assign_to_group($this->incident, $group_id);

        $this->viewModal = false;
        $this->reset('searchTerm');
        $this->emitTo('view-ticket.status-button','renderStatus');

        $this->emit('updateAssigned', $desc);
        $this->dispatchBrowserEvent('update_success');


    }

    public function openModal()
    {
        $this->viewModal = true;
    }

}
