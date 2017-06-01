<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;

class MessageController extends Controller
{
    public function create($id)
    {
        $threadID = $id;
        return view('message.reply',compact('threadID'));
    }
    
    public function store()
    {
        $threadID = request('threadID');
        $body = request('body');
        $user = Auth::user();
        
        //create new message
        $message = new Message();
        $message->body = $body;
        $message->user_id = $user->id;
        $message->thread_id = $threadID; 
        $message->save();
        
        return redirect('/inbox');
    }
}
