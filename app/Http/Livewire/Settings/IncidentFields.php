<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use App\Models\Settings;

class IncidentFields extends Component
{
    public $locActive;

    public function mount()
    {
        $this->locActive = settings::where('type','location')->pluck('active')->first();

    }

    public function render()
    {

        $setting = Settings::where('type','fields')->first();

        $fields = $setting->json;

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

        $setting = Settings::where('type','fields')->first();
        $array = $setting->json;

        $count = count($array);

        for($i = 0; $i < $count; $i++)
        {

            if($array[$i]['field'] == strtolower($text))
            {

                $array[$i]['active'] = $condition;
            }
        }

        $setting->json = $array;
        $setting->save();

        return;

    }

    public function toggleCheck($text)
    {
        $setting = Settings::where('type','fields')->first();
        $array = $setting->json;

        $count = count($array);

        for($i = 0; $i < $count; $i++)
        {

            if($array[$i]['field'] == strtolower($text))
            {

                $array[$i]['mandatory'] = ! $array[$i]['mandatory'];
            }
        }

        $setting->json = $array;
        $setting->save();

        return;
    }
}
