<?php
namespace App\Service;


use App\Models\status_history;
use Auth;

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
        $incident->assigned_group = NULL;
        $incident->save();
        

        $history = ['incident_id' => $incident->id,
                'status' => 4,
                'user_id' => Auth::id(),
                'assigned_to' => Auth::id()
        ];
        

        status_history::create($history);

        return;
      
    }

    public function assign_to($incident, $user_id)
    {
       
        $incident->status = 4;
        $incident->assigned_to = $user_id; 
        $incident->assigned_group = NULL;
        $incident->save();

        $history = ['incident_id' => $incident->id,
                'status' => 4,
                'user_id' => Auth::id(),
                'assigned_to' => $user_id
        ];

        status_history::create($history);

        return;

    }

    public function assign_to_group($incident, $group_id)
    {

        $incident->status = 1;
        $incident->assigned_to = NULL;
        $incident->assigned_group = $group_id; 
        $incident->save();

        $history = ['incident_id' => $incident->id,
                'status' => 4,
                'user_id' => Auth::id(),
                'assigned_group' => $group_id
        ];

        status_history::create($history);

        return;
    }

    public function resolve($incident)
    {
        $incident->status = 5;
        $incident->assigned_to = Auth::id();
        $incident->assigned_group; 
        $incident->save();

        $history = ['incident_id' => $incident->id,
                'status' => 5,
                'user_id' => Auth::id(),
                'assigned_group' => NULL,
        ];

        status_history::create($history);

        return;
    }

    public function updateIncident($incident, $status)
    {
        $incident->status = $status;
        $incident->save();

        $history = ['incident_id' => $incident->id,
                'status' => 5,
                'user_id' => Auth::id(),
                
        ];

        status_history::create($history);

        return;
    }
    
}