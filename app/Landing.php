<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Landing extends Model
{
  public function store()
  {
      return $this->belongsTo('App\Store');
  }
  public function records()
  {
      return $this->hasMany('App\Record')->orderBy('created_at', 'desc');
  }
}
