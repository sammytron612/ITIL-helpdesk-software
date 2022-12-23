<?php
namespace App\Service;

use App\Models\agent_group;
use App\Events\NewIncident;
use App\Traits\getUserMembers;
use Exception;


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

        $message = "A new ticket hasd been created and is assigned to a group you are a member of. Incident No:{$incident->id} titled `{$incident->title}`";

        try
        {
            broadcast(new NewIncident($incident->id,$message,$users))->toOthers();
        } catch (Exception $e)
        {

        }


        return true;
    }

    private function decideGroup($incident)
    {
        return;
    }
}
