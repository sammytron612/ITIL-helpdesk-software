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

    public $searchTerm = '';
    public $sortBy = '';
    public $choice = 'all';
    public $field = false;
    public $value = false;

    public $allColumns = ['id','status','title','priority','category', 'sub_category', 'agent_group', 'assigned_to','created_by','site','department','reassignments','created_at','updated_at'];
    public $storedColumns = [];


    private $incidents = [];
    public $selectedCheckBoxes = ["true","true","true","true","true","true","true","true","true","true","true","true","true","true"];
    public $numberShown = 25;


    protected $listeners = ['changeSearch'];


   public function render()
    {

        $this->incidents =  incidents::select('incidents.id as id','status.name as status', 'incidents.title as title','category.name as category',
            'priority.name as priority','sub_category.name as sub_category',
                'agent_group.name as agent_group', 'assigned_to.name as assigned_to', 'created_by.name as created_by',
                    'site.name as site','department.name as department', 'incidents.reassignments as reassignments',
                    'incidents.created_at as created_at','incidents.updated_at as updated_at')
            ->leftJoin('statuses as status', 'incidents.status', '=', 'status.id')
            ->leftJoin('categories as category', 'incidents.category', '=', 'category.id')
            ->leftJoin('priorities as priority', 'incidents.priority', '=', 'priority.id')
            ->leftJoin('sub_categories as sub_category', 'incidents.sub_category', '=', 'sub_category.id')
            ->leftJoin('agent_groups as agent_group', 'incidents.agent_group', '=', 'agent_group.id')
            ->leftJoin('sites as site', 'incidents.site', '=', 'site.id')
            ->leftJoin('departments as department', 'incidents.department', '=', 'department.id')
            ->leftJoin('users as assigned_to', 'incidents.assigned_to', '=', 'assigned_to.id')
            ->leftJoin('users as created_by', 'incidents.created_by', '=', 'created_by.id')
            ->when($this->field)->where(function ($query) {
                    $query->where($this->field,'=', $this->value)
                    ->where(function($query){
                        $query->where('assigned_to.name', 'LIKE', $this->searchTerm . "%")
                             ->orWhere('created_by.name', 'LIKE', $this->searchTerm . "%")
                             ->orWhere('incidents.id', $this->searchTerm)
                             ->orWhere('status.name', 'LIKE', $this->searchTerm . '%')
                             ->orWhere('priority.name', 'LIKE', $this->searchTerm . '%')
                             ->orWhere('category.name', 'LIKE', $this->searchTerm . "%")
                             ->orWhere('agent_group.name', 'LIKE', $this->searchTerm . "%");
                        })

                    ;})
            ->when(!$this->field)->where(function($query){
                        $query->where('assigned_to.name', 'LIKE', $this->searchTerm . "%")
                             ->orWhere('created_by.name', 'LIKE', $this->searchTerm . "%")
                             ->orWhere('incidents.id', $this->searchTerm)
                             ->orWhere('status.name', 'LIKE', $this->searchTerm . '%')
                             ->orWhere('priority.name', 'LIKE', $this->searchTerm . '%')
                             ->orWhere('category.name', 'LIKE', $this->searchTerm . "%")
                             ->orWhere('agent_group.name', 'LIKE', $this->searchTerm . "%");
                        })


                ->when($this->sortBy)->orderBy($this->sortBy,$this->sortDirection)
                    ->when(!$this->sortBy)->orderBy('incidents.created_at','desc')
                    ->paginate($this->numberShown);

        return view('livewire.incidents.incident-table', ['incidents' => $this->incidents]);
    }

    public function sortByColumn()
    {

        $this->IncidentQuery();
        //$this->incidents = incidents::with(['created_by','assigned_agent','group','priorities','statuses','chosen_site','departments'])->orderBy($column,$this->sortDirection)->paginate(25);
        //$this->resetPage();
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

    public function updatedselectedCheckBoxes()
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

        $this->currentChoice = $choice;
     //$this->incidents = $this->IncidentQuery('created_at',$choice);
        //$this->incidents = incidents::where('status', 1)->paginate($this->numberShown);

        if ($choice == 'all') {
            $this->field = null;
            $this->IncidentQuery();
        } elseif ($choice == 'resolved') {
            $this->IncidentQuery('status.name', 'resolved');
        } elseif ($choice == 'new') {
           $this->IncidentQuery('status.name','new');
        } elseif ($choice == 'me') {
            $this->IncidentQuery('assigned_to.name', Auth::user()->name);
        } elseif ($choice == 'breach') {
            //$this->incidents = incidents::paginate($this->numberShown);
        } else{
            $this->IncidentQuery();
        }

    }

    private function IncidentQuery($field = null, $value = null)
    {

        if($field) {$this->field = $field;}
        if($value) {$this->value = $value;}

        return;

    }

}
