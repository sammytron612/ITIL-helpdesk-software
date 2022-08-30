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

        ->when(in_array($this->sortBy,['status','priority','User','category','sub_category','department','site']), function ($query) use($model){
            $query->orderBy($model::select('name')->whereColumn('id', 'incidents.'. $this->field), $this->sortDirection);
            })
        ->when(in_array($this->sortBy,['id','updated_at','created_at']))
            ->orderBy($this->sortBy, $this->sortDirection)
        ->when(!$this->sortBy)
            ->orderBy('id','desc')
        ->paginate($this->numberShown);




        //dd($incidents);
//dd($this->value);
      /*  $this->incidents =  incidents::select('incidents.id as id','status.name as status', 'incidents.title as title','category.name as category',
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
            ->when($this->field && $this->field !='status.id')->where(function ($query) {
                    $query->where($this->field, $this->value)
                    ->when($this->searchTerm)->where(function($query){
                        $query->where('assigned_to.name', 'LIKE', $this->searchTerm . "%")
                             ->orWhere('created_by.name', 'LIKE', $this->searchTerm . "%")
                             ->orWhere('incidents.id', $this->searchTerm)
                             ->orWhere('status.name', 'LIKE', $this->searchTerm . '%')
                             ->orWhere('priority.name', 'LIKE', $this->searchTerm . '%')
                             ->orWhere('category.name', 'LIKE', $this->searchTerm . "%")
                             ->orWhere('agent_group.name', 'LIKE', $this->searchTerm . "%");
                        })

                    ;})
            ->when($this->field && $this->field =='status.id')->where(function ($query) {
                $query->whereNotIn($this->field, $this->value)
                ->when($this->searchTerm)
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

            ->when(!$this->field && $this->searchTerm)->where(function($query){
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
*/
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
