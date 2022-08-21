<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Http;
use App\Events\SendNotification;
use App\Events\NewIncident;
use Auth;
use App\Events\UpdateIncident;
use App\Notifications\UpdateIncident as mailUser;

class TestController extends Controller
{
    public function index()
    {
        //$data = ['id' => 1];
        //Auth::user()->notify(new mailUser($data));
        event(new updateIncident(1)); 

       /*Auth::user()->notify(new mailKev(Auth::user()));
        event(new updateIncident(1));*/
    }
}