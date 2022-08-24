<?php

namespace App\Http\Controllers;

use App\Events\NewComment;
use Illuminate\Support\Facades\Http;
use App\Events\SendNotification;
use App\Events\NewIncident;
use Auth;
use App\Events\UpdateIncident;
use App\Notifications\UpdateIncident as mailUser;
use App\Models\incidents;

class TestController extends Controller
{
    public function index()
    {
        broadcast(new NewIncident(incidents::find(43)))->toOthers();

        //$data = ['id' => 1];
        //Auth::user()->notify(new mailUser($data));
        return view('test.test');
        //event(new NewComment(37));

       /*Auth::user()->notify(new mailKev(Auth::user()));
        event(new updateIncident(1));*/
    }
}
