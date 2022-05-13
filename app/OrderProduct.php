<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{
    use SoftDeletes;
    
    protected $table = 'order_product';

    protected $fillable = [
        'order_id',
        'product_id',
        'unit_price',
        'qty',
        'price'
    ];

    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function order(){
        return $this->belongsTo('App\Order');
    }
}
