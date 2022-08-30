<?php
namespace App\Http\Livewire\Traits;


trait WithSorting
{
    public $sortDirection = 'asc';


    public function sortBy($model, $field = null)
    {

        $this->sortDirection = $this->sortBy === $model ? $this->reverseSort() : 'asc';

        $this->sortBy = $model;
        $this->field = $field;

        $this->incidentQuery();

    }

    public function reverseSort()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }
}
