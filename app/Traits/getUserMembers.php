<?php
namespace App\Traits;


use App\Models\group_membership;

trait getUserMembers
{
    private function getUsers($incident)
    {
        return [$incident->created_by, $incident->assigned_to];
    }



    private function getUsersFromGroup($incident)
    {

        $users = group_membership::where('agent_group', $incident->agent_group)->pluck('user_id')->toArray();

        return $users;
    }
}
