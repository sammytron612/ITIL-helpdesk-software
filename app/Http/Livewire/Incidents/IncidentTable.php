<?php

namespace App\Http\Livewire\Incidents;

use Livewire\Component;
use App\Models\incidents;
use Livewire\WithPagination;
use Auth;
use App\Http\Livewire\Traits\WithSorting;



class IncidentTable extends Component
{
    use WithSorting;
    use WithPagination;



    private $choice = 'all';
    private $incidents = [];

    public $sortBy;
    public $searchTerm = '';
    public $field;
    public $filter = 'id';
    public $value = 0;
    public $operator = '>';

    public $allColumns = ['id','status','title','priority','category', 'sub_category', 'agent_group', 'assigned_to','created_by','site','department','reassignments','created_at','updated_at'];
    public $storedColumns = [];

    public $selectedCheckBoxes = ["true","true","true","true","true","true","true","true","true","true","true","true","true","true"];
    public $numberShown = 25;


    protected $listeners = ['changeSearch'];



   public function render()
    {

        $model = "\App\models\\" . $this->sortBy;

        $this->incidents = incidents::withAllRelations()
            ->when(!Auth::user()->isAgent())->Where(function($query){
                $query->where('created_by', Auth::id());
            })
            ->when($this->operator != "not", function ($query){
                $query->where($this->filter,$this->operator, $this->value);
            })
            ->when($this->operator == "not", function ($query){
                $query->whereNotIn($this->filter, $this->value);
            })
            ->when($this->searchTerm)->Where(function($query){
                $query->whereRelation('assigned_agent', 'name','LIKE', $this->searchTerm . "%")
                    ->orWhereRelation('requested_by','name', 'LIKE', $this->searchTerm . "%")
                    ->orWhere('incidents.id', $this->searchTerm)
                    ->orWhereRelation('statuses','name', 'LIKE', $this->searchTerm . '%')
                    ->orWhereRelation('priorities','name', 'LIKE', $this->searchTerm . '%')
                    ->orWhereRelation('categories','name', 'LIKE', $this->searchTerm . "%")
                    ->orWhereRelation('group','name', 'LIKE', $this->searchTerm . "%");
                })

        ->when(in_array($this->sortBy,['status','priority','User','category','sub_category','department','sites']), function ($query) use($model){
            $query->orderBy($model::select('name')->whereColumn('id', 'incidents.'. $this->field), $this->sortDirection);
            })
        ->when(in_array($this->sortBy,['id','updated_at','created_at']))
            ->orderBy($this->sortBy, $this->sortDirection)
        ->when(!$this->sortBy)
            ->orderBy('id','desc')
        ->paginate($this->numberShown);

        return view('livewire.incidents.incident-table', ['incidents' => $this->incidents]);
    }

    public function sortByColumn()
    {

        $this->IncidentQuery();

    }

    public function updatedstoredColumns()
    {

        foreach($this->allColumns as $key => $column)
        {
            if(!in_array($column, $this->storedColumns)){
                $this->selectedCheckBoxes[$key] = false;
            }
        }
        $this->IncidentQuery();

    }

    public function updateSelectedCheckBoxes()
    {

        $i = 0;

        foreach($this->selectedCheckBoxes as $check)
        {
            if(!$check)
            {
                unset($this->storedColumns[$i]);
            }
            else
            {
                $this->storedColumns[$i] = $this->allColumns[$i];
            }

            $i++;
        }


        $this->dispatchBrowserEvent('updateColumns', ['cols' => $this->storedColumns]);


        $this->IncidentQuery();


    }

    /*
    public function newIncidentRow()
    {
        if($this->choice == 'all')
        {
            $this->field = null;
            $this->incidentQuery();
        }
    }
    */

    public function changeSearch($choice)
    {

        $this->reset('searchTerm');
        $this->sortBy = '';
        $this->field = '';

        $this->currentChoice = $choice;
     //$this->incidents = $this->IncidentQuery('created_at',$choice);
        //$this->incidents = incidents::where('status', 1)->paginate($this->numberShown);

        if ($choice == 'all') {
            $this->IncidentQuery('id','>','0');
        } elseif ($choice == 'resolved') {
            $this->IncidentQuery('status', '=', 5);
        } elseif ($choice == 'unassigned') {
            $this->IncidentQuery('assigned_to', '=', NULL);
        } elseif ($choice == 'new') {
           $this->IncidentQuery('status','=',1);
        } elseif ($choice == 'me') {
            $this->IncidentQuery('assigned_to', '=', Auth::id());
        }  elseif ($choice == 'open') {
            $this->IncidentQuery('status','not',[5,10,11]);
        } elseif ($choice == 'breach') {
            //$this->incidents = incidents::paginate($this->numberShown);
        } else{
            $this->IncidentQuery();
        }

        return;
    }

    private function IncidentQuery($filter = null, $operator = null, $value = null)
    {

        if($filter) {$this->filter = $filter;}
        if($operator) {$this->operator = $operator;}
        if($value) {$this->value = $value;}

        return;

    }



}
