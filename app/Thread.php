<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Message;
use App\Thread;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Thread extends Model
{
  use SoftDeletes;
  protected $fillable=['subject'];
  protected $dates = ['deleted_at'];

  /**
   * Get the messages  belonging to this thread.
  */
  public function messages()
  {
      $messages = Message::where('thread_id',$this->id)->get();
      return $messages;
  }
  
  public function isOwner($threadID)
  {
      $user = Auth::user();
      $message = Message::where('thread_id',$threadID)->first();
      if($user->id == $message->user_id){
          return true;
      } else {
          return false;
      }
  }
  
    public function isOwnerDeleted($threadID)
  {
      $user = Auth::user();
      $message = Message::onlyTrashed()->where('thread_id',$threadID)->first();
      if($user->id == $message->user_id){
          return true;
      } else {
          return false;
      }
  }
}
