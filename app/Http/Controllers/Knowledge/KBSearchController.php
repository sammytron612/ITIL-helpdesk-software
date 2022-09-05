<?php

namespace App\Http\Controllers\Knowledge;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class KBSearchController extends Controller
{
    public function index()
    {
        return view('knowledge.search');
    }
}
