<?php
namespace App\Http\Livewire\Traits;


trait WithSorting
{
    public $sortBy = '';
    public $sortDirection = 'desc';

    public function sortBy($field)
    {

        $this->sortDirection = $this->sortBy === $field ? $this->reverseSort() : 'asc';

        $this->sortBy = $field;

        $this->sortByColumn($field);

    }

    public function reverseSort()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }
}

