<?php

namespace App\Http\Livewire\Incidents;

use Livewire\Component;
use App\Models\incidents;
use Livewire\WithPagination;
use Auth;


class IncidentTable extends Component
{

    use WithPagination;


    private $incidents;

    public $numberShown = 25;

    public $user;

    protected $listeners = ['changeSearch'];

    public function mount()
    {
        $this->incidents = incidents::with(['created_by','assigned_agent'])->orderBy('created_at','desc')->paginate($this->numberShown);

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


}
