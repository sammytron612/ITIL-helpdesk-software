<?php

namespace App\Http\Livewire\ViewTicket;

use Livewire\Component;

class Modal extends Component
{
    protected $listeners = ['openModal'];
    public $viewModal = false;


    public function render()
    {
        return view('livewire.view-ticket.modal');
    }

    public function openModal()
    {
        $this->dispatchBrowserEvent('close-tiny', ['newName' => 'ok']);
        $this->viewModal = true;
    }
}