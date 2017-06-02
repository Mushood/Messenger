<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\Thread;
use App\User;
use App\Participant;
use Illuminate\Support\Facades\DB;

class ThreadController extends Controller
{
    public function index(){
        $user = Auth::user();
        $participatingThreads = Participant::where('user_id',$user->id)->groupBy('id')->get();
        //echo $participatingThreads;
        $threadsID = array();
        foreach($participatingThreads as $participatingThread){
            array_push($threadsID, $participatingThread->thread_id);
        }
        $threads = Thread::find($threadsID);

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
      $to = request('to');
      $errors = "";
      $successful = "";
      $user = Auth::user();
      
      DB::transaction(function () use ($body, &$errors, &$successful, $user, $to,$subject) {

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

        $participant = new Participant;
        $participant->user_id = $user->id;
        $participant->thread_id = $thread->id;
        $participant->save();

        $recipients = explode(",", $to);
        
        foreach($recipients as $recipient){
            $userR = User::where('email',$recipient)->first();
            if(isset($userR)){
              $participant = new Participant;
              $participant->user_id = $userR->id;
              $participant->thread_id = $thread->id;
              $participant->save();
              $successful = $successful . "Email was successfully sent to: ". $recipient . "<br />";
            } else {
              $errors = $errors . "This is not a valid email: " . $recipient . "<br />";
            }
        }
      });
      if(empty($errors)){
        return redirect('/inbox');
      } else {
        return view('message.create',compact('errors','successful'));
      }

    }

    public function delete(){
      $threadID = request('thread');

      $messages = Message::where('thread_id',$threadID)->get();
      foreach ($messages as $key => $message) {
        $message->delete();
      }

      $participants = Participant::where('thread_id',$threadID)->get();
      foreach ($participants as $key => $participant) {
        $participant->delete();
      }

      $thread = Thread::find($threadID);
      $thread->delete();
      return redirect('/inbox');
    }
    
    public function deleteIndex(){
        $user = Auth::user();
        $participatingThreads = Participant::onlyTrashed()->where('user_id',$user->id)->groupBy('id')->get();
        //echo $participatingThreads;
        $threadsID = array();
        foreach($participatingThreads as $participatingThread){
            array_push($threadsID, $participatingThread->thread_id);
        }
        $threads = Thread::onlyTrashed()->find($threadsID);
        return view('message.indexdeleted',compact('threads'));
    }
    
    public function restore(){
      $threadID = request('thread');

      $messages = Message::onlyTrashed()->where('thread_id',$threadID)->get();
      foreach ($messages as $key => $message) {
        $message->restore();
      }

      $participants = Participant::onlyTrashed()->where('thread_id',$threadID)->get();
      foreach ($participants as $key => $participant) {
        $participant->restore();
      }

      $thread = Thread::onlyTrashed()->find($threadID);
      $thread->restore();
      return redirect('/deletedmessages');
    }
    
    public function sent(){
        $threadAlls = Thread::all();
        $user = Auth::user();
        $threadsID = array();
        foreach($threadAlls as $threadAll){
            $message = Message::where('thread_id',$threadAll->id)->first();
            if($user->id == $message->user_id){
                array_push($threadsID, $message->thread_id);
            } else {
                //do nothing
            }
        }
        $threads = Thread::find($threadsID);
        return view('message.sent',compact('threads'));
    }
    
    public function forward(){
        $threadID = request('thread');
        $thread = Thread::find($threadID);
        
        $body = "";
        foreach($thread->messages() as $message){
            $body = $body . "Written by: " .$message->user()->name . " <br />";
            $body = $body . $message->body . " <br />";
        }
        return view('message.create')->with('body', $body);
    }
}

            