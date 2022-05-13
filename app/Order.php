<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'subtotal', 
        'dto',
        'total',
        'user_id',
        'status_id',
        'payment_type',
        'debt'
    ];


    /**
     * Relaciones
     */
    public function items(){
        return $this->hasMany('App\OrderProduct');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function status(){
        return $this->belongsTo('App\Status');
    }

    public function payment_type(){
        return $this->belongsTo('App\PaymentType');
    }

    public function payments(){
        return $this->hasMany('App\Payment');
    }
}
