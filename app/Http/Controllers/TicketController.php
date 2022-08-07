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


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function index()
    {
        /*
        sub_category::create(['title' => 'Email', 'parent' => 4]);
        sub_category::create(['title' => 'Sharepoint', 'parent' => 4]);
        sub_category::create(['title' => 'Excel', 'parent' => 4]);
        sub_category::create(['title' => 'Outlook', 'parent' => 4]);

        dd("kl");*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       
        $sites = sites::all();
        $priorities = priority::all();
        $departments = department::all();

        return view('ticket.create-ticket', compact(['sites', 'priorities', 'departments']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:5|max:80',
            'category' => 'required',
            'priority' => 'required',
            'comment' => 'required',
        ]);


        $array = [
            'status' => 1,
            'title' => $request->title,
            'priority' => $request->priority,
            'requestor' => Auth::id(),
            'category' => $request->category,
            'site' => $request->site,
            'department' => $request->department,
            'sub_category' => $request->sub_category,
        ];

        $return = incidents::create($array);

        $comment = [
            'comment' => $request->comment,
            'incident_no' => $return->id
        ];
        

        updates::create($comment);

        $history = ['incident_id' => $return->id,
                    'status' => 1,
                    'user_id' => Auth::id(),
        ];

        status_history::create($history);

        return redirect()->back()->with('message', 'Success!');
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
        $ticket->load('ticket_updates');
        
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
}