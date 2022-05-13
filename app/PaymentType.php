<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $table = 'payment_types';

    public $timestamps = false;

    public function orders(){
        return $this->hasMany('App\Order');
    }
}
