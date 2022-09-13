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

        //assign to default group//

        $default = agent_group::where('global_default', 1)->first();
        $incident->agent_group = $default->id;

        $incident->save();

        $users = $this->getUsersFromGroup($incident);

        $message = "A new ticket hasd been created and is assigned to a group you are a member of No:{$incident->id} titled `{$incident->title}`";
        //dd($incident->id,$message,$users);
        broadcast(new NewIncident($incident->id,$message,$users))->toOthers();

        return true;
    }
}
