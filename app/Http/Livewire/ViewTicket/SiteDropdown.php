<?php

namespace App\Http\Livewire\ViewTicket;

use Livewire\Component;

use App\Models\sites;
use App\Models\incidents;

class SiteDropdown extends Component
{
    public $incident;
    public $showing;
    private $sites;

    public function mount(incidents $incident)
    {
        $this->showing = $incident->chosen_site?->name;
        $this->incident = $incident;
        
    }


    public function render()
    {
        $this->sites = sites::all();
        return view('livewire.view-ticket.site-dropdown',['sites' => $this->sites]);
    }

    public function updateSite(sites $site)
    {
      
        $this->incident->site = $site->id;
        $this->incident->save();

        $this->showing = $site->name;
        $this->dispatchBrowserEvent('update-success');

    }
}
