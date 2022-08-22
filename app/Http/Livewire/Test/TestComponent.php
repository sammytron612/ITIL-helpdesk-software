<?php

namespace App\Http\Livewire\Test;

use Livewire\Component;
use App\Events\NewComment;
use App\Models\incidents;
use App\Models\User;

class TestComponent extends Component
{


    public function render()
    {
        $r = incidents::where('id',37)->first();
        $requestor = $r->requestor;
        $user = User::where('id',$requestor)->first();
        $message = "hjhjh";
        event(new NewComment($user, $message, 37)); 
        return view('livewire.test.test-component');
    }

}