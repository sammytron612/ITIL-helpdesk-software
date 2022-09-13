<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\incidents;
use App\Models\updates;
use Auth;
use App\Models\department;
use App\Models\priority;
use App\Models\sites;
use App\Models\status_history;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Interfaces\optionalFields;
use App\Models\Settings;
use App\Service\TicketWorkflow;
use Session;



class TicketController extends Controller implements optionalFields
{

    public $settings;

    public function __construct()
    {
        $this->settings = Settings::first();
    }


    public function create()
    {
        $sites = null;
        $departments = null;


        if($this->isToBeShown('location')) { $sites = Sites::all(); }
        if($this->isToBeShown('departments')) { $departments = department::all(); }
        $subCategory = $this->isToBeShown('subcategory');

        $deptMandatory = $this->isMandatory('department');
        $locMandatory = $this->isMandatory('location');
        $subMandatory = $this->isToBeShown('subcategory');

        $priorities = priority::all();

        return view('ticket.create-ticket', compact(['sites', 'priorities', 'departments','subCategory', 'deptMandatory','locMandatory','subMandatory']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TicketWorkflow $ticketWorkflow)
    {

        $array = [
            'title' => 'required|min:5|max:250',
            'category' => 'required',
            'priority' => 'required',
            'comment' => 'required',

        ];


        if($this->isMandatory('department'))
        {
            $array['department'] =  'required';
        }
        if($this->isMandatory('location'))
        {
            $array['site'] =  'required';
        }
        if($this->isMandatory('subcategory'))
        {
            $array['sub_category'] = 'required';
        }


        $validated = $request->validate($array);


        $array = [
            'status' => 1,
            'title' => $request->title,
            'priority' => $request->priority,
            'created_by' => Auth::id(),
            'category' => $request->category,
            'site' => $request->site,
            'department' => $request->department,
            'sub_category' => $request->sub_category,
        ];

        $return = incidents::create($array);

        $comment = [
            'comment' => $request->comment,
            'incident_no' => $return->id,
            'user_id' => Auth::id()
        ];


        updates::create($comment);

        $history = ['incident_id' => $return->id,
                    'status' => 1,
                    'user_id' => Auth::id(),
        ];

        status_history::create($history);

        $return = $ticketWorkflow->newTicket(incidents::find($return->id));

        Session::flash('msg', 'Success' );


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(incidents $ticket)
    {

        throw_if(
            !Auth::user()->isAdmin() && $ticket->created_by != Auth::id(),
            AuthorizationException::class,
            'You are not allowed to access this!'
        );


        $ticket->load(['requested_by','assigned_agent']);
        /*
        $ticket->load(['ticket_updates' => function($query) {
            $query->orderBy('created_at');
        }]);
        */
        return view('ticket.edit-ticket', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function isToBeShown($field)
    {


        $optional = $this->settings->optional_fields;

        $key = array_search($field, array_column($optional,'field'));

        if($optional[$key]['active'])
        {

            return true;
        }
        else {
            return false;
        }
    }

    public function isMandatory($field)
    {

        $optional = $this->settings->optional_fields;

        $key = array_search($field, array_column($optional,'field'));

        if($optional[$key]['mandatory'])
        {

            return true;
        }
        else {
            return false;
        }

    }
}
