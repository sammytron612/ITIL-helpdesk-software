<?php

namespace App\Http\Livewire\ViewTicket;

use Livewire\Component;
use App\Models\category;
use App\Models\incidents;

class CategoryDropdown extends Component
{
    public $incident;
    public $showing;


    public function mount()
    {
        $this->showing = $this->incident->categories?->name;

    }


    public function render()
    {
        $categories = category::all();
        return view('livewire.view-ticket.category-dropdown',['categories' => $categories]);
    }

    public function updateCategory(category $category)
    {
        $this->incident->category = $category->id;
        $this->incident->sub_category = NULL;
        $this->incident->save();

        $this->showing = $category->name;
        $this->dispatchBrowserEvent('update-success');
        $this->emit('updateSub');
    }
}
