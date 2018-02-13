<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];

  public function pages()
  {
      return $this->hasMany('App\Page')->orderBy('weight');
  }
  public function blocks()
  {
      return $this->hasMany('App\Block')->orderBy('weight');
  }
  public function landings()
  {
      return $this->hasMany('App\Landing')->orderBy('created_at', 'desc');
  }
  public function records()
  {
      return $this->hasMany('App\Record')->orderBy('created_at', 'desc');
  }
  public function user()
  {
      return $this->belongsTo('App\User');
  }
}
