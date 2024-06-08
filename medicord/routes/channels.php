<?php

use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('user.{sender_id}.{receiver_id}', function ($user, $sender_id, $receiver_id) {
    //deve ritornare qualcosa, questo attiva il canale che tu sia il sender loggato o il receiver loggato. 
    return (int) $user->id === (int) $sender_id || (int) $user->id === (int) $receiver_id;
    // return true;
});
