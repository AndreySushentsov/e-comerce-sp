<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
  protected $table = 'producer';
  public function products()
  {
    return $this->belongsToMany('App\Product');
  }
}
