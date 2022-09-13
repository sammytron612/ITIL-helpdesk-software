<?php

namespace App\Http\Livewire\Tickets;

use Livewire\Component;
use App\Models\sub_category;

class SubcategoryDropdown extends Component
{

    protected $listeners = ['categoryChanged'];

    private $subCategories = [];
    public $old_sub;
    public $sub_category;
    public $category;

    public function mount()
    {
        if($this->old_sub)
        {
            $this->sub_category= $this->old_sub;
        }
    }

    public function render()
    {
        $this->subCategories = sub_category::where('parent', $this->category)->get();
        return view('livewire.tickets.subcategory-dropdown', ['subCategories' => $this->subCategories]);
    }

    public function categoryChanged($category)
    {
        $this->category = $category;
    }
}
