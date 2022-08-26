<?php

namespace App\Http\Livewire\Incidents;

use Livewire\Component;
use App\Models\incidents;
use Livewire\WithPagination;
use Auth;
use App\Http\Livewire\Traits\WithSorting;
use Illuminate\Support\Facades\DB;



class IncidentTable extends Component
{
    use WithSorting;
    use WithPagination;

    public $sortBy = '';
    public $field = false;
    public $value = false;

    public $allColumns = ['id','status','title','priority','category', 'sub_category', 'agent_group', 'assigned_to','created_by','site','department','reassignments','created_at','updated_at'];
    public $storedColumns = [];


    private $incidents = [];
    public $selectedCheckBoxes = ["true","true","true","true","true","true","true","true","true","true","true","true","true","true"];
    public $numberShown = 20;


    protected $listeners = ['changeSearch'];

    public function mount()
    {

        $this->user = Auth::user();
    }


    public function getListeners()
    {
        return ["echo-private:newincident.{$this->user->id},NewIncident" => 'newIncident',
                'changeSearch'
    ];
    }


   public function render()
    {
        return view('livewire.incidents.incident-table', ['incidents' => $this->incidents]);
    }

    public function sortByColumn()
    {

        $this->incidents = $this->IncidentQuery();
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
        $this->incidents = $this->IncidentQuery();

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


        $this->incidents = $this->IncidentQuery();


    }

    public function changeSearch($choice)
    {

     //$this->incidents = $this->IncidentQuery('created_at',$choice);
        //$this->incidents = incidents::where('status', 1)->paginate($this->numberShown);

        if ($choice == 'all') {
            $this->field = null;
            $this->incidents = $this->IncidentQuery();
        } elseif ($choice == 'resolved') {
            $this->incidents = $this->IncidentQuery('status.name', 'resolved');
        } elseif ($choice == 'new') {
            $this->incidents = $this->IncidentQuery('status.name','new');
        } elseif ($choice == 'me') {
            $this->incidents = $this->IncidentQuery('assigned_to.name', "kevin wilson");
        } elseif ($choice == 'breach') {
            $this->incidents = incidents::paginate($this->numberShown);
        } else{
            $this->incidents = $this->IncidentQuery();
        }

    }

    private function IncidentQuery($field = null, $value = null)
    {


        if($field) {$this->field = $field;}
        if($value) {$this->value = $value;}


        return $this->incidents = incidents::select('incidents.id as id','status.name as status', 'incidents.title as title','category.name as category',
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
            ->when($this->field)->where($this->field,'=', $this->value)
                ->when($this->sortBy)->orderBy($this->sortBy,$this->sortDirection)
                    ->when(!$this->sortBy)->orderBy('incidents.created_at',$this->sortDirection)
                        ->paginate(25);

    }

}
