<?php

namespace App\Http\Livewire\ViewTicket;

use Livewire\Component;


use App\Models\incidents;
use App\Models\sub_category;

class SubCategoryDropdown extends Component
{

    public $incident;
    public $showing;

    protected $listeners = ['updateSub' => 'reRender'];


    public function mount(incidents $incident)
    {
        $this->showing = $incident->sub_categories?->name;
        $this->incident = $incident;

    }


    public function render()
    {
        $sub_categories = [];
        $sub_categories = sub_category::where('parent',$this->incident->category)->get();

        return view('livewire.view-ticket.sub-category-dropdown', ['sub_categories' => $sub_categories]);
    }

    public function updateSubCategory(sub_category $sub_category)
    {
        $this->incident->sub_category = $sub_category->id;
        $this->incident->save();

        $this->showing = $sub_category->title;
        $this->dispatchBrowserEvent('update-success');
    }

    public function reRender()
    {
        $this->showing = "";
        $this->render();
    }
}
