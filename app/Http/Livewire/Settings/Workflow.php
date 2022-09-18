<?php

namespace App\Http\Livewire\Settings;

use App\Models\agent_group;
use Livewire\Component;

class Workflow extends Component
{
    public $location;

    public $default;

    public function mount()
    {
        $this->default = agent_group::where('global_default',1)->pluck('id')->first();

    }


    public function render()
    {

        $groups = agent_group::all();

        return view('livewire.settings.workflow',['groups' => $groups]);
    }

}
