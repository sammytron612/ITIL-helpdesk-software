<?php

namespace App\Http\Livewire\ViewTicket;

use Livewire\Component;
use App\Models\incidents;
use App\Models\status_action;
use App\Service\UpdateTicket;

use Auth;

class StatusButton extends Component
{
    public $chosenAction = 0;
    public $incident_no;
    public $incident;
    public $status_actions;
    
    protected $listeners = ['renderStatus'];

    public function mount()
    {

        $miss = [];
        
        $this->status_actions = status_action::orderBy('action')->get();

    }

    public function render()
    {
        $this->incident = incidents::find($this->incident_no);
        //$this->name = $this->incident->assigned?->name;

        return view('livewire.view-ticket.status-button');
    }

    public function updatedchosenAction()
    {
        $ticket = new UpdateTicket;
        
        if($this->chosenAction == 1) /* Assign to self */
        {
            
            $ticket->assign_self($this->incident);
            $this->dispatchBrowserEvent('update-success');
            $this->chosenAction = 0;
            
        } elseif ($this->chosenAction == 2) {  /* assign to */ 
            
            $this->emit('openModal');
        
        }
        elseif ($this->chosenAction == 3) {  /* resolve */
            
            $ticket->resolve($this->incident);
            $this->dispatchBrowserEvent('update-success');
            $this->chosenAction = 0;
        }
        else
        {  //everything else //

            $temp = status_action::find($this->chosenAction);

            $ticket->updateIncident($this->incident, $temp->status->id);
            $this->dispatchBrowserEvent('update-success');
            $this->chosenAction = 0;
            
        }
        
    }

    public function renderStatus()
    {
        $this->chosenAction = 0;
        $this->render();
        $this->dispatchBrowserEvent('update-success');
    }
}