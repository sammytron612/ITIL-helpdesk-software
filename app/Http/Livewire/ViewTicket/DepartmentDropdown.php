<?php

namespace App\Http\Livewire\ViewTicket;

use Livewire\Component;

use App\Models\department;
use App\Models\incidents;

class DepartmentDropdown extends Component
{
    public $incident;
    public $showing;
    

    public function mount(incidents $incident)
    {
        $this->showing = $incident->departments->title;
        $this->incident = $incident;
        
    }

    public function render()
    {
        $departments = department::all();
        
        return view('livewire.view-ticket.department-dropdown',['departments'=> $departments]);
    }

    public function updateDepartment(department $department)
    {
        $this->incident->site = $department->id;
        $this->incident->save();

        $this->showing = $department->title;
        $this->dispatchBrowserEvent('update-success');
    }
}
