<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{
  use SoftDeletes;
  protected $fillable=['user_id','thread_id'];
  protected $dates = ['deleted_at'];
}
