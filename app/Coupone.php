<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupone extends Model
{
    public static function findByCode()
    {
      return self::where('code', $code)->first();
    }

    public function discount($total)
    {
        if($this->type == 'fixed'){
          return $this->value;
        } elseif($this->type == 'percent'){
          return ($this->percent_off / 100) * $total;
        } else{
          return 0;
        }
    }
}
