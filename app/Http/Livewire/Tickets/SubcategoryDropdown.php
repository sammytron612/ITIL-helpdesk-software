<?php

namespace App\Http\Livewire\Tickets;

use Livewire\Component;
use App\Models\sub_category;

class SubcategoryDropdown extends Component
{

    protected $listeners = ['categoryChanged'];

    private $subCategories = [];

    public function render()
    {
        return view('livewire.tickets.subcategory-dropdown', ['subCategories' => $this->subCategories]);
    }

    public function categoryChanged($category)
    {
        $this->subCategories = sub_category::where('parent', $category)->get();
    }
}