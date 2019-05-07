<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    //

    protected $fillable = ['order_id','product_id', 'quantity'];

    public function orders()
    {
        return $this->belongsTo('App\Order','order_id','id');
    }


    public function products()
    {
        return $this->belongsTo('App\Product','product_id','id');
    }

    public function users() {
        return $this->belongsTo('App\User','user_id','id');
    }
}
