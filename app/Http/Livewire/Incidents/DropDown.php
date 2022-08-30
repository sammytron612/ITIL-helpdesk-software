<?php

namespace App\Http\Livewire\incidents;

use Livewire\Component;

class DropDown extends Component
{

    public $showing = "All Incidents";

    public function render()
    {
        return view('livewire.incidents.drop-down');
    }

    public function choice($choice)
    {
        switch ($choice) {
            case 'all':
                $this->showing = "All Incidents";
                $this->emit('changeSearch', 'all');
                break;
            case ('completed'):
                $this->showing = "Resloved Incidents";
                $this->emit('changeSearch', 'resolved');
                break;
            case ('unassigned'):
                $this->showing = "Unassigned Incidents";

                $this->emit('changeSearch', 'unassigned');
                break;
            case ('new'):
                $this->showing = "New Incidents";
                $this->emit('changeSearch', 'new');
                break;
            case ('me'):
                $this->showing = "Incidents assigned to me";
                $this->emit('changeSearch', 'me');
                break;
            case ('allOpen'):
                $this->showing = "All open";
                $this->emit('changeSearch', 'open');
                break;
            case ('sla'):
                $this->showing = "Incidents close to SLA breach";
                $this->emit('changeSearch', 'open');
                break;
        }
    }
}
