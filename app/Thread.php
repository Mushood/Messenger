<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Message;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
