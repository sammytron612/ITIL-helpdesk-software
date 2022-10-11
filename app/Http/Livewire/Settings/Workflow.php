<?php

namespace App\Http\Livewire\Settings;

use App\Models\agent_group;
use Livewire\Component;
use App\Models\Settings;

class Workflow extends Component
{
    public $location;
    public $default;
    public $category;

    public function mount()
    {
        $this->default = agent_group::where('global_default',1)->pluck('id')->first();
        $this->category = Settings::where('type','category')->pluck('active')->first();
        $this->location = Settings::where('type','location')->pluck('active')->first();

    }


    public function render()
    {

        $groups = agent_group::all();

        return view('livewire.settings.workflow',['groups' => $groups]);
    }

}
