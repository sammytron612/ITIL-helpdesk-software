<?php

namespace App\Http\Livewire\ViewTicket;

use Livewire\Component;
use App\Models\updates;
use Auth;
use App\Service\UpdateTicket as updateTicket;
use App\Events\IncidentEvent;
use App\Models\group_membership;

class CommentComponent extends Component
{
    public $ticket;
    public $comments;
    public $comment;
    public $public = true;



    public function render()
    {

        $this->comments = updates::with('user','user.my_avatar')->where('incident_no', $this->ticket->id)->orderBy('created_at','desc')->get();


        return view('livewire.view-ticket.comment-component');
    }

    public function newComment($comment, $mention)
    {

        if($mention)
            {
                $updateTicket = new updateTicket;

                $mention[0]['id'];
                $array = explode('-',$mention[0]['id']);
                $id = $array[0];
                $type = $array[1];


                $name = $mention[1]['name'];


                /////////////////// email and re-assign ticket /////////////

                if($type == 'agent')
                {
                    $updateTicket->assign_to($this->ticket, $id);
                }
                else{
                    $updateTicket->assign_to_group($this->ticket, $id);

                }


                $this->emitTo('view-ticket.assign', 'updateAssigned', $name);
            }

        $update = ['comment' => $comment,
                   'incident_no' => $this->ticket->id,
                   'user_id' => Auth::id(),
                   'public' => $this->public

        ];

        updates::create($update);


        $this->dispatchBrowserEvent('update-success');

        $this->sendNotification();

        $this->render();


    }

    public function updateComment(updates $update, $comment, $mention)
    {

        $type = null;


        if($mention)
            {
                $updateTicket = new updateTicket;

                $mention[0]['id'];
                $array = explode('-',$mention[0]['id']);
                $id = $array[0];
                $type = $array[1];


                $name = ltrim($mention[1]['name'], '@');


                /////////////////// email and re-assign ticket /////////////


            }


        $update->comment = $comment;
        $update->public = $this->public;
        $update->save();

        if($type)
        {

            if($type === 'agent')
                {
                    $updateTicket->assign_to($update->incident, $id);
                }
                else
                {
                    $updateTicket->assign_to_group($update->incident, $id);

                }

            $this->emitTo('view-ticket.assign', 'updateAssigned', $name);

        }

        $this->dispatchBrowserEvent('update-success');

    }


    public function publicToggle()
    {
        $this->public = ! $this->public;
    }

    public function updatePublicToggle(updates $update)
    {
        $public = $update->public;
        $public = ! $public;
        $update->public = $public;
        $update->save();


    }

    private function sendNotification()
    {
        if($this->ticket->assignedToAgent())
        {
            $users = $this->getUsers();
        }
        else {$users = $this->getUsersFromGroup();}

        $incidentId = (int) $this->ticket->id;
        $message = "A new comment has been added to incident no: {$this->ticket->id} titled `{$this->ticket->title}`";
        broadcast(new IncidentEvent($incidentId,$message,$users))->toOthers();

        return;
    }

    private function getUsers()
    {
        return [$this->ticket->rcreated_by, $this->ticket->assigned_to];
    }

    private function getUsersFromGroup()
    {
        $users = group_membership::where('agent_group', $this->ticket->assigned_group)->pluck('user_id')->toArray();
        $users[] = $this->ticket->requestor;

        return $users;
    }


}

