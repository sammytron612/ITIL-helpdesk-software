<?php

namespace App\View\Components;

use Illuminate\View\Component;

class avatar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $name;
    public $colour;

    public function __construct($name,$colour)
    {
        $this->name = $name;
        $this->colour = $colour;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.avatar');
    }
}
