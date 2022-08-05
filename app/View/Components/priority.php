<?php

namespace App\View\Components;

use Illuminate\View\Component;

class priority extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $priority;


    public function __construct($priority)
    {
        $this->priority = $priority;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.priority');
    }
}
