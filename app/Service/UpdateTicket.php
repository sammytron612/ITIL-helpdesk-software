<?php
namespace App\Service;


use App\Models\status_history;
use Auth;
use App\Events\IncidentEvent;
use App\Models\group_membership;

class UpdateTicket
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function assign_self($incident)
    {

        $incident->status = 4;
        $incident->assigned_to = Auth::id();
        $incident->agent_group = NULL;
        $incident->save();


        $history = ['incident_id' => $incident->id,
                    'status' => 4,
                    'user_id' => Auth::id(),
                    'assigned_to' => Auth::id()
        ];


        status_history::create($history);

        $incident->refresh();
        $this->newAssigned($incident);

        return $incident->assigned_agent->name;

    }

    public function assign_to($incident, $user_id)
    {

        $incident->status = 4;
        $incident->assigned_to = $user_id;
        $incident->agent_group = NULL;
        $incident->save();

        $history = ['incident_id' => $incident->id,
                'status' => 4,
                'user_id' => Auth::id(),
                'assigned_to' => $user_id
        ];

        status_history::create($history);

        $incident->refresh();
        $this->newAssigned($incident);

        return $incident->assigned_agent->name;

    }

    public function assign_to_group($incident, $group_id)
    {

        $incident->status = 1;
        $incident->assigned_to = NULL;
        $incident->agent_group = $group_id;
        $incident->save();

        $history = ['incident_id' => $incident->id,
                'status' => 4,
                'user_id' => Auth::id(),
                'assigned_group' => $group_id
        ];

        status_history::create($history);

        $incident->refresh();
        $this->newAssigned($incident);

        return $incident->group->name;
    }

    public function resolve($incident)
    {
        $incident->status = 5;
        $incident->assigned_to = Auth::id();
        $incident->save();

        $history = ['incident_id' => $incident->id,
                'status' => 5,
                'user_id' => Auth::id(),
                'assigned_group' => NULL,
        ];

        status_history::create($history);

        $incident->refresh();
        $this->newStatus($incident);

        return;
    }

    public function updateIncident($incident, $status)
    {

        $incident->status = $status;
        $incident->assigned_to = Auth::id();
        $incident->save();
        $history = status_history::where('incident_id', $incident->id)->orderBy('created_at','desc')->first();

        if(!$history)
        {
            $assigned_to = Auth::id();
            $assigned_group = NULL;
        }else
        {
            $assigned_to = $history->assigned_to;
            $assigned_group = $history->assigned_group;
        }


        $history = ['incident_id' => $incident->id,
                'status' => $status,
                'user_id' => Auth::id(),
                'assigned_to' => $assigned_to,
                'assigned_group' => $assigned_group

        ];

        status_history::create($history);

        $incident->refresh();
        $this->newStatus($incident);

        return;
    }

    private function newAssigned($incident)
    {
        if($incident->assigned_to)
        {
            $users = $this->getUsers($incident);
            $name = $incident->assigned_agent->name;
        }
        else {
            $users = $this->getUsersFromGroup($incident);
            $name = $incident->group->name;
        }

        $message = "Your Incident No:{$incident->id} titled `{$incident->title}` has been assigned to {$name}";

        broadcast(new IncidentEvent($incident->id,$message,$users))->toOthers();

        return;
    }

    public function newStatus($incident)
    {
        if($incident->assignedToAgent())
        {
            $users = $this->getUsers($incident);

        }
        else {
            $users = $this->getUsersFromGroup($incident);
        }

        $message = "The status on Incident No:{$incident->id} titled `{$incident->title}` has been set to {$incident->statuses->status}";

        broadcast(new IncidentEvent($incident->id,$message,$users))->toOthers();

        return;
    }

    private function getUsers($incident)
    {
        return [$incident->created_by, $incident->assigned_to];
    }



    private function getUsersFromGroup($incident)
    {
        $users = group_membership::where('agent_group', $incident->assigned_group)->pluck('user_id')->toArray();
        $users[] = $incident->requestor;

        return $users;
    }

}
