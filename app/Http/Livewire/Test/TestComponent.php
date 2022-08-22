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
        $incident = incidents::find(37);
       
        $pushTo = $incident->requesting_user;
        
        $message = "hjhjh";
        event(new NewComment($pushTo, 37)); 
        return view('livewire.test.test-component');
    }

}