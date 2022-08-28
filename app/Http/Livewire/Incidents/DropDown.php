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

    public function all()
    {
        $this->showing = "All Incidents";

        $this->emit('changeSearch', 'all');
    }

    public function completed()
    {
        $this->showing = "Resloved Incidents";

        $this->emit('changeSearch', 'resolved');
    }

    public function new()
    {
        $this->showing = "New Incidents";
        $this->emit('changeSearch', 'new');
    }

    public function me()
    {
        $this->showing = "Incidents assigned to me";
        $this->emit('changeSearch', 'me');
    }

    public function allOpen()
    {
        $this->showing = "All open";
        $this->emit('changeSearch', 'open');
    }

    public function sla()
    {
        $this->showing = "Incidents close to beach";
        $this->emit('changeSearch', 'breach');
    }
}
