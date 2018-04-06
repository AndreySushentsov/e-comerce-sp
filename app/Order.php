<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
      'user_id','billing_region','billing_post-code','billing_city', 'billing_street', 'billing_house',
      'billing_flat','billing_name','billing_surname', 'billing_email', 'billing_phone','billing_comments', 'billing_discount',
      'billing_discount_code', 'billing_subtotal', 'billing_total',
    ];

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function products()
    {
      return $this->belongsToMany('App\Product')->withPivot('quantity');
    }
}
