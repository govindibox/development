<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function profile(){
        return $this->hasOne('App\Models\UserProfile', 'user_id', 'id');
    }

    function role(){
        //return $this->belongsToMany('App\Models\Role','App\Models\UserProfile','user_id','role_id');
        return $this->hasOneThrough('App\Models\Role','App\Models\UserProfile','user_id','id');
    }

    function transaction(){
        return $this->hasMany('App\Models\UserPayment', 'user_id', 'id');
    }
}
