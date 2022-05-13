<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    public $timestamps = false;
    
    /**
     * Relaciones
     */
    public function users(){
        return $this->hasMany('App\User');
    }
}
