<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Http;
use App\Events\SendNotification;

class TestController extends Controller
{
    public function index()
    {
        event(new sendNotification('hello'));
    }
}