<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use App\Models\sites;
use App\Models\Settings;
use App\Models\agent_group;

class LocationBased extends Component
{

    public $locations;
    public $groups;
    public $rules;
    public $autoAllocate;
    public $robin;
    public $least;
    public $array;
    public $locationActive;


    public function mount()
    {
        $this->array = Settings::where('type', 'location')->first();
        $this->locationActive = $this->array->active;

        if($this->array->allocation == 1)
        {
            $this->autoAllocate = true;
            $this->robin = true;
        }
        elseif($this->array->allocation == 2)
        {

            $this->autoAllocate = true;
            $this->least = true;
        }

    }

    public function render()
    {
        $this->locations = sites::all();
        $this->groups = agent_group::all();
        $this->rules = $this->getRules();


        return view('livewire.settings.location-based');
    }

    public function addRule($location, $group)
    {
        //$array = Settings::where('type', 'category')->first();

        $rules = json_decode($this->array->json);

        $match = false;
        if($rules)
        {
            foreach($rules as $rule)
            {
                if($rule->location == $location)
                {
                    $rule->group = $group;
                    $match = true;

                }
            }
        }

        if(!$match)
        {
            $rules[] = ['location' => $location,
            'group' => $group];
        }


        $json = json_encode($rules);
        $this->array->json = $json;
        $this->array->save();
    }

    public function updatedautoAllocate()
    {
        if($this->autoAllocate)
        {
            $array = Settings::where('type', 'location')->update(['allocation' => 1]);
        }
        else{
            $array = Settings::where('type', 'location')->update(['allocation' => 0]);
            $this->robin = false;
            $this->least = false;
        }

    }

    public function updatedrobin()
    {
        if($this->robin) {$this->least = false;}
        $array = Settings::where('type', 'location')->update(['allocation' => 1]);
    }

    public function updatedleast()
    {
        if($this->least) {$this->robin = false;}
        $array = Settings::where('type', 'location')->update(['allocation' => 2]);
    }

    public function updatedlocationActive()
    {
        if($this->locationActive)
        {
            Settings::where('type', 'location')->update(['active' => 1]);
            Settings::where('type', 'category')->update(['active' => 0]);
            $setting = Settings::where('type', 'fields')->first();
            $fields = $setting->json;

            $index = 0;
            foreach($fields as $field)
            {
                if($field['field'] == 'location')
                {
                    break;
                }
                $index++;
            }


            $fields[$index]['active'] = true;
            $fields[$index]['mandatory'] = true;
            $setting->json = $fields;
            $setting->save();

        }
        else
        {
            Settings::where('type', 'location')->update(['active' => 0]);
        }
    }

    protected function getRules()
    {
        $array = $this->array;

        return json_decode($array->json);
    }
}
