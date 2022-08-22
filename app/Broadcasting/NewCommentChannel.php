<?php

namespace App\Broadcasting;

use App\Models\User;
use App\Models\incidents;
use Auth;

class NewCommentChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User  $user
     * @return array|bool
     */
    public function join(User $user, $incident)
    { 
        $requestor = incidents::find($incident);
        $id = $requestor->requestor;
        return   (int) $user->id === (int) $id;
       
    }
}
