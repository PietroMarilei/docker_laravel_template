<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class NewMessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }
    // quesato evento costruice il messaggio da Message, e lo "trasmette" sul canale privato user.{id}
    public function broadcastOn()
    {
        //idea ordinare gli id in ordine crescente cosí sono sempre uguali
        $idUser = Auth::id();
        $idReceiver = $this->message->receiver_id;
        $idsOrderedArr = [$idUser, $idReceiver];
        sort($idsOrderedArr);
        $channelName = implode('.', $idsOrderedArr);
        //$idUnivoco = hash('sha256', $channelName);;
        //gli di sono ordinati in ordine crescente
        return new PrivateChannel('user.' . $channelName);
        // return new PrivateChannel('user.' . Auth::id() . '.' . $this->message->receiver_id);
    }
}
