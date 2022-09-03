<?php

namespace App\Http\Controllers;

use App\Events\NewComment;
use Illuminate\Support\Facades\Http;
use App\Events\SendNotification;
use App\Events\NewIncident;
use Auth;
use Storage;


class TestController extends Controller
{
    public function index()
    {

        dd(base64_decode('MTY2MjIwNjMyMTEwNDgyNTk2XzkwOTUxODA5OTEwODI2MV81MDk2NjIxMTUyMzA3MTY5NTE0X24uanBn'));
        storage::delete('public/images/kev.jpg');

        //$response = Http::withToken(env('API_TOKEN'))->get('http://localhost:9000/api/search/test');

//return $response->body();
       /* $incidents = incidents::with('assigned_agent', 'requested_by', 'group','statuses','departments','priorities','categories','sub_categories','chosen_site')
                        ->whereRelation('assigned_agent', 'name','=', 'kevin wilson')
                        ->orWhereRelation('requested_by', 'name','like', 'kevin%')
                        ->whereRe

                        ->get();
        //broadcast(new NewIncident(incidents::find(43)))->toOthers();

        //$data = ['id' => 1];
        //Auth::user()->notify(new mailUser($data));
        return view('test.test');
        //event(new NewComment(37));

       /*Auth::user()->notify(new mailKev(Auth::user()));
        event(new updateIncident(1));*/
die();
        return view('test.test');
    }

}
