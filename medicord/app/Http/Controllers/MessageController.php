<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


use \App\Events\NewMessageSent;

class MessageController extends Controller
{
    // public function index()
    // {
    //     $user = auth()->user();
    //     $messages = Message::where('receiver_id', $user->id)->get();
    //     // dd($messages);

    //     return Inertia::render('Messages/MessageIndex', ['messages'=>$messages]);
    // }

    // public function show($sender_id)
    // {
    //     $user = auth()->user();
    //     $messages = Message::where('sender_id', $sender_id)
    //         ->where('receiver_id', $user->id)
    //         ->get();
    //     return Inertia::render('Messages/MessageShow', compact('messages'));
    // }
    public function index($receiverId)
    {
        $userId = auth()->id();
        $sentMessages = Message::where('sender_id', $userId)
            ->where('receiver_id', $receiverId)
            ->get();
        $receivedMessages = Message::where('sender_id', $receiverId)
        ->where('receiver_id', $userId)
            ->get();
        // $allMessagesall = Message::where('sender_id', $userId)->where(function ($query) {
        //     $query->where(sender)->orWhere(sender);
        // })
        $allMessages = $sentMessages->merge($receivedMessages);
        //dd($allMessages);
        return Inertia::render('SingleChat', [
            'userId' => $userId,
            'receiverId' => $receiverId,
            // 'sentMessages' => $sentMessages,
            // 'receivedMessages'=> $receivedMessages,
            'allMessages'=> $allMessages
        ]);
    }

    public function sendNewMessage(Request $request)
    {
        $userId = Auth::id();

        if(!$userId) { // BUG VOLONTARIO PER INSOMNIA / POSTMAN
            $userId = $request->input('senderId');
        }

        // dd($request->all());
        $message = new Message([
            'sender_id' => $userId,
            'receiver_id'=> $request->input('receiverId'),
            'message' => $request->input('message'),
        ]);

        
        $message->save();
        // Broadcast the message to Soketi
        broadcast(new NewMessageSent($message));

        // Send back to axios
        return response()->json([
            'success' => true,
            'data' => [
                'receiver_id' => $request->input('receiverId'),
                'message' => $request->input('message'),
            ]
        ]);
    
}}
