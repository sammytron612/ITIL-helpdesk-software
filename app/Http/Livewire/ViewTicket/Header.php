<?php

namespace App\Http\Livewire\ViewTicket;

use Livewire\Component;

class Header extends Component
{

    public $ticket;

    public function __mount($ticket)
    {
        $this->ticket = $ticket;
    }

    public function render()
    {
        return view('livewire.view-ticket.header');
    }
}
