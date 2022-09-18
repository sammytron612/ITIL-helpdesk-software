<?php

namespace App\Http\Livewire\Settings;

use App\Models\agent_group;
use Livewire\Component;
use App\Models\category;
use App\Models\Settings;


class CategoryBased extends Component
{
    private $categories;
    private $groups;

    public function mount()
    {
        $this->categories = category::all();
        $this->groups = agent_group::all();
    }

    public function render()
    {
        $this->categories = category::all();
        $this->groups = agent_group::all();
        return view('livewire.settings.category-based',['categories' => $this->categories, 'groups' => $this->groups]);
    }

    public function addRule($category, $group)
    {
        $array = Settings::where('type', 'category')->first();

        $rules = json_decode($array->json, true);

        $match = false;
        if($rules)
        {
            foreach($rules as $rule)
            {
                if($rule['category'] == $category)
                {
                    $rule['group'] = $group;
                    $match = true;
                    dd($rule);
                }
            }
        }

        if(!$match)
        {
            $rules[] = ['category' => $category,
            'group' => $group];
        }

        dd($rules);
        $json = json_encode($rules);
        $array->json = $json;
        dd($array);

        $array->save();

        $array = Settings::where('type', 'category')->first();



    }
}
