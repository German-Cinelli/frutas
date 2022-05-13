<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    /**
     * Relaciones
     */
    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function orders(){
        return $this->hasMany('App\Order');
    }


    public function isAdmin(){
        if($this->role_id == 1){
            return true;
        } else {
            return false;
        }
        //return $this->admin ? true : false; // this looks for an admin column in your users table
    }

    public function isCustomer(){
        if($this->role_id == 2){
            return true;
        } else {
            return false;
        }
    }
}
