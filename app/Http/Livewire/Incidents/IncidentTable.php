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

    public $allColumns = [];
    public $storedColumns = [];

    private $incidents = [];
    public $selectedCheckBoxes = ["true","true","true","true","true","true","true","true","true","true","true","true","true","true"];
    public $numberShown = 20;


    protected $listeners = ['changeSearch'];

    public function mount()
    {

        $columns = DB::select(DB::raw("SHOW COLUMNS FROM incidents"));

        foreach($columns as $column)
        {
            $array = (get_object_vars($column));

            array_push($this->allColumns, $array['Field']);
        }

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

    public function sortByColumn($column)
    {

        $this->incidents = $this->IncidentQuery($column);
        //$this->incidents = incidents::with(['created_by','assigned_agent','group','priorities','statuses','chosen_site','departments'])->orderBy($column,$this->sortDirection)->paginate(25);
        $this->resetPage();
    }

    public function updatedstoredcolumns()
    {

        foreach($this->allColumns as $key => $column)
        {
            if(!in_array($column, $this->storedColumns)){
                $this->selectedCheckBoxes[$key] = false;
            }
        }
        $this->incidents = $this->IncidentQuery('created_at');

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


        $this->incidents = $this->IncidentQuery('created_at');

    }

    public function nextPage()
    {

        //$this->emitSelf('postAdded',2);
    }

    public function changeSearch($choice)
    {
        $this->incidents = incidents::where('status', 1)->paginate($this->numberShown);

        if ($choice == 'all') {
            $this->incidents = incidents::paginate($this->numberShown);
        } elseif ($choice == 'resolved') {
            $this->incidents = incidents::where('status', 4)->paginate($this->numberShown);
        } elseif ($choice == 'new') {
            $this->incidents = incidents::where('status', 1)->paginate($this->numberShown);
        } elseif ($choice == 'me') {
            $this->incidents = incidents::where('assigned_to', Auth::id())->paginate($this->numberShown);
        } elseif ($choice == 'breach') {
            $this->incidents = incidents::paginate($this->numberShown);
        }

    }

    public function newIncident($incident)
    {
        dd($incident);
    }

    private function IncidentQuery($column)
    {
        return $this->incidents = DB::table("incidents")
                    ->leftJoin("statuses", function($join){
                        $join->on("incidents.status", "=", "statuses.id");
                    })
                    ->leftJoin("priorities", function($join){
                        $join->on("incidents.priority", "=", "priorities.id");
                    })
                    ->leftJoin("categories", function($join){
                        $join->on("incidents.category", "=", "categories.id");
                    })
                    ->leftJoin("sub_categories", function($join){
                        $join->on("incidents.sub_category", "=", "sub_categories.id");
                    })
                    ->leftJoin("agent_groups", function($join){
                        $join->on("incidents.assigned_group", "=", "agent_groups.id");
                    })
                    ->leftJoin("sites", function($join){
                        $join->on("incidents.site", "=", "sites.id");
                    })
                    ->leftJoin("users AS users1", "incidents.assigned_to", "=", "users1.id")
                    ->leftJoin("users AS users2", "incidents.requestor", "=", "users2.id")
                    ->leftJoin("departments", function($join){
                        $join->on("incidents.department", "=", "departments.id");
                    })
                    ->select("incidents.id", "statuses.status", "incidents.title", "priorities.priority", "categories.title as category", "sub_categories.title as sub_category", "agent_groups.name as assigned_group","users1.name as assigned_to", "users2.name as requestor", "sites.name as site","departments.title as department", "incidents.reassignments", "incidents.created_at", "incidents.updated_at")
                    ->orderBy($column,$this->sortDirection)
                    ->paginate(25);
    }

}
