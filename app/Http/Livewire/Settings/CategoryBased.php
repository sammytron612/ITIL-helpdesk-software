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
    public $array;
    public $categoryActive;


    public function mount()
    {
        $this->array = Settings::where('type', 'category')->first();
        $this->categoryActive = $this->array->active;

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
        $this->categories = category::all();
        $this->groups = agent_group::all();
        $this->rules = $this->getRules();


        return view('livewire.settings.category-based');
    }

    public function addRule($category, $group)
    {
        //$array = Settings::where('type', 'category')->first();

        $rules = json_decode($this->array->json);

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
        $this->array->json = $json;
        $this->array->save();
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

    public function updatedcategoryActive()
    {
        if($this->categoryActive)
        {
            Settings::where('type', 'category')->update(['active' => 1]);
            Settings::where('type', 'location')->update(['active' => 0]);
        }
        else
        {
            Settings::where('type', 'category')->update(['active' => 0]);
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
        $array = $this->array;

        return json_decode($array->json);
    }
}
