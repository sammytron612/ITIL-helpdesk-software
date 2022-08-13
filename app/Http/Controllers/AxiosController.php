<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\agent_group;


class AxiosController extends Controller
{
    public function fetchData()
    {
        $array = [];
        $agents = User::select('id','name','email')->where('role','agent')->get();
        $agentGroups = agent_group::select('id','name','email')->get();

        foreach($agents as $agent)
        {
            $array[] = ['id' => '@' . $agent->name,
                        'userId' => $agent->id . '-' . 'agent',
                        'name' => $agent->name,
                        'email' => $agent->email,
            
                ];
        }

        foreach($agentGroups as $group)
        {
            
            $array[] = ['id' => '@' . $group->name,
                        'userId' => $group->id . '-' . 'group',
                        'name' => $group->name,
                        'email' => $group->email
                    ];
                        
        }
        
        
        return response()->json(['agents' => $array]);
    }
}
