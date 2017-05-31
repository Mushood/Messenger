<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\Thread;

class ThreadController extends Controller
{
    public function index(){
        $threads = Thread::all();
        /* FOR TESTING
        foreach ($threads as $thread){
            echo $thread->subject;
            //var_dump($thread->messages());
            foreach($thread->messages() as $message){
                echo $message->body;
            }
        }
        die();
         * */
        return view('message.index',compact('threads'));
    }
    
    public function create(){
        return view('message.create');
    }
    
    public function store(){
        $subject = request('subject');
        $body = request('body');
        $user = Auth::user();
        
        //create new thread
        $thread = new Thread();
        $thread->subject = $subject;
        $thread->save();
        
        //create new message
        $message = new Message();
        $message->body = $body;
        $message->user_id = $user->id;
        $message->thread_id = $thread->id; 
        $message->save();
        
        return redirect('/inbox');
    }
}
