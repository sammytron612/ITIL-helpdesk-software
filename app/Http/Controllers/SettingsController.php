<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function fields()
    {
        return view('settings.fields');
    }
}