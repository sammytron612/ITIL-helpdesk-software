<?php

namespace App\Http\Livewire\Settings;

use App\Models\agent_group;
use Livewire\Component;
use App\Models\category;
use App\Models\Settings;


class CategoryBased extends Component
{

    public $categories;
    public $groups;
    public $rules;
    public $autoAllocate;
    public $robin;
    public $least;


    public function mount()
    {
        $array = Settings::where('type', 'category')->first();
        if($array->allocation == 1)
        {
            $this->autoAllocate = true;
            $this->robin = true;
        }
        elseif($array->allocation == 2)
        {
            $this->autoAllocate = true;
            $this->least = true;
        }

    }

    public function render()
    {
        $this->categories = category::all();
        $this->groups = agent_group::all();
        $this->rules = $this->getRules();


        return view('livewire.settings.category-based');
    }

    public function addRule($category, $group)
    {
        $array = Settings::where('type', 'category')->first();

        $rules = json_decode($array->json);

        $match = false;
        if($rules)
        {
            foreach($rules as $rule)
            {
                if($rule->category == $category)
                {
                    $rule->group = $group;
                    $match = true;

                }
            }
        }

        if(!$match)
        {
            $rules[] = ['category' => $category,
            'group' => $group];
        }


        $json = json_encode($rules);
        $array->json = $json;
        $array->save();
    }

    public function updatedautoAllocate()
    {
        if($this->autoAllocate)
        {
            $array = Settings::where('type', 'category')->update(['allocation' => 1]);
        }
        else{
            $array = Settings::where('type', 'category')->update(['allocation' => 0]);
            $this->robin = false;
            $this->least = false;
        }

    }

    public function updatedrobin()
    {
        if($this->robin) {$this->least = false;}
        $array = Settings::where('type', 'category')->update(['allocation' => 1]);
    }

    public function updatedleast()
    {
        if($this->least) {$this->robin = false;}
        $array = Settings::where('type', 'category')->update(['allocation' => 2]);
    }

    protected function getRules()
    {
        $array = Settings::where('type', 'category')->first();

        return json_decode($array->json);
    }
}
