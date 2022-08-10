<?php

namespace App\Http\Livewire\ViewTicket;

use Livewire\Component;
use App\Models\updates;
use Auth;

class CommentComponent extends Component
{
    public $ticket;
    public $comments;
    public $comment;


    public function render()
    {
       
        $this->comments = updates::where('incident_no', $this->ticket->id)->orderBy('created_at','desc')->get();
        

        return view('livewire.view-ticket.comment-component');
    }

    public function updatedcomment()
    {
        $update = ['comment' => $this->comment,
                   'incident_no' => $this->ticket->id,
                   'user_id' => Auth::id()
        ];

        updates::create($update);

        $this->dispatchBrowserEvent('update-success');
    }

    public function commentUpdated(updates $update, $comment)
    {
        $update->comment = $comment;
        $update->save();
    }
}
