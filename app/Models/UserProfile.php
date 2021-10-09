<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UserProfile extends Model
{
    protected $fillable = ['user_id','first_name','last_name','mobile','dob','role_id']; 
    use HasFactory;
    public function user(){
        return $this->belongsTo('App\Models\User', 'id', 'user_id');
    }

    function role(){
        return $this->hasOne('App\Models\Role', 'id', 'role_id');
    }

    function user_picture(){
        return Storage::url($this->picture);
    }
}
