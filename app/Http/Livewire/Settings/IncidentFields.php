<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use App\Models\Settings;

class IncidentFields extends Component
{

    public function render()
    {
        $settings = Settings::first();
        $fields = $settings->optional_fields;

        return view('livewire.settings.incident-fields', ['fields' => $fields]);
    }

    public function addField($text)
    {
        $this->loopOver($text, true);

        return;
    }

    public function removeField($text)
    {
        $this->loopOver($text, false);

        return;
    }

    private function loopOver($text, $condition)
    {

        $setting = Settings::first();
        $array = $setting->optional_fields;

        $count = count($array);

        for($i = 0; $i < $count; $i++)
        {

            if($array[$i]['field'] == strtolower($text))
            {

                $array[$i]['active'] = $condition;
            }
        }

        $setting->optional_fields = $array;
        $setting->save();

        return;

    }

    public function toggleCheck($text)
    {
        $setting = Settings::first();
        $array = $setting->optional_fields;

        $count = count($array);

        for($i = 0; $i < $count; $i++)
        {

            if($array[$i]['field'] == strtolower($text))
            {

                $array[$i]['mandatory'] = ! $array[$i]['mandatory'];
            }
        }

        $setting->optional_fields = $array;
        $setting->save();

        return;
    }
}
