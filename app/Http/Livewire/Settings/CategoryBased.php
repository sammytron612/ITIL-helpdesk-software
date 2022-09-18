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

    protected function getRules()
    {
        $array = Settings::where('type', 'category')->first();

        return json_decode($array->json);
    }
}
