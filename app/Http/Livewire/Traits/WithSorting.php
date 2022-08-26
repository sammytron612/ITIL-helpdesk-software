<?php
namespace App\Http\Livewire\Traits;


trait WithSorting
{
    public $sortDirection = 'asc';


    public function sortBy($field)
    {

        $this->sortDirection = $this->sortBy === $field ? $this->reverseSort() : 'asc';

        $this->sortBy = $field;

        $this->incidentQuery();

    }

    public function reverseSort()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }
}
