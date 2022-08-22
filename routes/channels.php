<?php

use Illuminate\Support\Facades\Broadcast;
use App\Broadcasting\NewCommentChannel;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/
/*
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('notification.{userId}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
*/
//Broadcast::channel('newcomment.{userId}', NewCommentChannel::class);
Broadcast::channel('newcomment.{userId}', function ($user, $userId) {
    
    return (int) $user->id === (int) $userId;
   
});

Broadcast::channel('changeownershipagent.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});
