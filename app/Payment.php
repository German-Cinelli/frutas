<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id', 
        'payment',
        'debito'
    ];

    /**
     * Relaciones
     */
    public function order(){
        return $this->belongsTo('App\Order');
    }
}
