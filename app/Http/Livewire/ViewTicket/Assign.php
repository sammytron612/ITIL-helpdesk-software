<?php

namespace App\Http\Livewire\ViewTicket;

use Livewire\Component;

use App\Models\incidents;

class Assign extends Component
{

    public $incident;
    public $showing;

    protected $listeners = ['updateAssigned'];

    public function mount(incidents $incident)
    {

        $this->incident = $incident;

    }

    public function render()
    {

         $this->incident->assigned_agent ? $this->showing = $this->incident->assigned_agent?->name : $this->showing = $this->incident->group?->name;

        return view('livewire.view-ticket.assign');
    }

    public function updateAssigned($desc)
    {

        $this->showing = $desc;

    }
}
