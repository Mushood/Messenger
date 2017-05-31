<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Thread;

class Message extends Model
{
    protected $fillable=['body','user_id','thread_id'];
    
    /**
     * Get the message thread.
    */
    public function thread()
    {
        $thread = Thread::where('id',  $this->thread_id);
        return $thread;
    }
    
    /**
     * Get the user who sent message.
    */
    public function user()
    {
        $user = User::where('id',$this->user_id)->first();
        return $user;
    }
}
