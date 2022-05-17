<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'stock',
        'image',
        'category_id',
        'qty_sold'
    ];


    /**
     * Relaciones
     */
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function items(){
        return $this->hasMany('App\OrderProduct');
    }
}
