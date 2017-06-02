<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\User;
use App\Participant;
use Illuminate\Support\Facades\DB;

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
        $to = request('to');
        $errors = "";
        $successful = "";
        $user = Auth::user();
        
        DB::transaction(function () use ($threadID, $body, &$errors, &$successful, $user,$to) {
            //create new message
            $message = new Message();
            $message->body = $body;
            $message->user_id = $user->id;
            $message->thread_id = $threadID; 
            $message->save();

            if(!empty($to)){
                $recipients = explode(",", $to);
                foreach($recipients as $recipient){
                    $userR = User::where('email',$recipient)->first();
                    if(isset($userR)){
                      $participant = new Participant;
                      $participant->user_id = $userR->id;
                      $participant->thread_id = $threadID;
                      $participant->save();
                      $successful = $successful . "Email was successfully sent to: ". $recipient . "<br />";
                    } else {
                      $errors = $errors . "This is not a valid email: " . $recipient . "<br />";
                    }
                }
            }
        });
        
        if(empty($errors)){
            return redirect('/inbox');
        } else {
            return view('message.reply',compact('errors','successful','threadID'));
        }   
        
        return redirect('/inbox');
    }
}
