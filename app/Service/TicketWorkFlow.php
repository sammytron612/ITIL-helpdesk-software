<?php
namespace App\Service;

use App\Models\agent_group;
use App\Events\NewIncident;



class TicketWorkflow
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */


    public function newTicket($incident)
    {
        $group = $incident->agent_group;
        $agent = $incident->assigned_to;
        $createdBy = $incident->created_by;

        $users = agent_group::where('id',$group)->pluck('id');
        //$users[] = $createdBy;
//dd($users);

        $message = "A new ticket hasd been created and is assigned to a group you are a member of No:{$incident->id} titled `{$incident->title}`";
        //dd($incident->id,$message,$users);
        broadcast(new NewIncident($incident->id,$message,$users))->toOthers();

        return true;
    }
}
