<?php

namespace App\Http\Livewire\Test;

use Livewire\Component;
use App\Events\NewComment;

class TestComponent extends Component
{


    public function render()
    {

        
        event(new NewComment(2)); 
        return view('livewire.test.test-component');
    }

}
