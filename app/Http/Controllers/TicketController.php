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



    public function create()
    {

        if($this->hasLocation()) { $sites = Sites::all(); }
        $priorities = priority::all();
        if($this->hasDepartments()) { $departments = department::all(); }
        $subCategory = $this->hasSubcategory();

        return view('ticket.create-ticket', compact(['sites', 'priorities', 'departments','subCategory']));
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

        if($this->hasDepartments())
        {
            $array['department'] =  'required';
        }
        if($this->hasLocation())
        {
            $array['site'] =  'required';
        }
        if($this->hasSubcategory())
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


    public function hasDepartments()
    {
        $settings = Settings::first();

        $optional = $settings->optional_fields;

        $key = array_search("department", array_column($optional,'field'));

        if($optional[$key]['active'])
        {

            return true;
        }
        else {
            return [];
        }
    }

    public function hasLocation()
    {
        $settings = Settings::first();

        $optional = $settings->optional_fields;
        $key = array_search("location", array_column($optional,'field'));

        if($optional[$key]['active'])
        {

            return true;
        }
        else {
            return [];
        }
    }

    public function hasSubcategory()
    {

        $settings = Settings::first();

        $optional = $settings->optional_fields;

        $key = array_search("subcategory", array_column($optional,'field'));

        if($optional[$key]['active'])
        {

            return true;
        }
        else {
            return false;
        }


    }
}
