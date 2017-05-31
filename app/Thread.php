<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Message;

class Thread extends Model
{
    protected $fillable=['subject'];
    
    /**
     * Get the messages  belonging to this thread.
    */
    public function messages()
    {
        $messages = Message::where('thread_id',$this->id)->get();
        return $messages;
    }
}
