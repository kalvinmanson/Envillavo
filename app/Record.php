<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
  public function chats()
  {
    return $this->hasMany('App\Chat')->orderBy('created_at', 'desc');
  }
}
