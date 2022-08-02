<?php

namespace App\Http\Livewire\ViewTicket;

use Livewire\Component;
use App\Models\status;

class StatusButton extends Component
{
    public $chosenStatus;
    public $class;
    public $statuses;


    public function mount()
    {

        $miss = [1, 2];
        $this->statuses = status::whereNotIn('id', $miss)->orderBy('status')->get();
    }

    public function render()
    {

        if ($this->chosenStatus == 1) {
            $this->class = "w-1/3 px-4 py-1 bg-blue-100 rounded-lg";
        }

        if ($this->chosenStatus == 2) {
            $this->class = "w-1/3 px-4 py-1 bg-orange-100 rounded-lg";
        }
        if ($this->chosenStatus == 3) {
            $this->class = "w-1/3 px-4 py-1 bg-yellow-100 rounded-lg";
        }
        if ($this->chosenStatus == 4) {
            $this->class = "w-1/3 px-4 py-1 bg-red-100 rounded-lg";
        }
        if ($this->chosenStatus == 5) {
            $this->class = "w-1/3 px-4 py-1 bg-cyan-100 rounded-lg";
        }
        if ($this->chosenStatus == 6) {
            $this->class = "w-1/3 px-4 py-1 bg-purple-100 rounded-lg";
        }
        if ($this->chosenStatus == 7) {
            $this->class = "w-1/3 px-4 py-1 bg-green-100 rounded-lg";
        }
        if ($this->chosenStatus == 8) {
            $this->class = "w-1/3 px-4 py-1 bg-indigo-100 rounded-lg";
        }
        if ($this->chosenStatus == 9) {
            $this->class = "w-1/3 px-4 py-1 bg-indigo-300 rounded-lg";
            $this->emit('openModal');
        }

        return view('livewire.view-ticket.status-button');
    }
}