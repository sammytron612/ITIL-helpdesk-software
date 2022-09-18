<?php
namespace App\Service;

use App\Models\agent_group;
use App\Events\NewIncident;
use App\Traits\getUserMembers;



class TicketWorkflow
{
    use getUserMembers;


    public function newTicket($incident)
    {
        $this->decideGroup($incident);

        $default = agent_group::where('global_default', 1)->first();
        $incident->agent_group = $default->id;
        $incident->save();
        $users = $this->getUsersFromGroup($incident);

        $message = "A new ticket hasd been created and is assigned to a group you are a member of No:{$incident->id} titled `{$incident->title}`";
        broadcast(new NewIncident($incident->id,$message,$users))->toOthers();

        return true;
    }

    private function decideGroup($incident)
    {

    }
}
