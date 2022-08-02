<?php

namespace App\Http\Livewire\Tickets;

use Livewire\Component;
use App\Models\category;


class CategoryDropdown extends Component
{
    public $category;
    private $categories;

    public function render()
    {

        $categories = category::all();
        return view('livewire.tickets.category-dropdown', compact('categories'));
    }

    public function updatedCategory($category)
    {
        $this->emit('categoryChanged', $category);
    }
}