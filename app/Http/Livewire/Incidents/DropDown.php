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

        $this->emit('changeSearch', '1');
    }

    public function completed()
    {
        $this->showing = "Resloved Incidents";

        $this->emit('changeSearch', '2');
    }

    public function new()
    {
        $this->showing = "New Incidents";
        $this->emit('changeSearch', '3');
    }

    public function me()
    {
        $this->showing = "Incidents assigned to me";
        $this->emit('changeSearch', '4');
    }

    public function sla()
    {
        $this->showing = "Incidents close to beach";
        $this->emit('changeSearch', '5');
    }
}