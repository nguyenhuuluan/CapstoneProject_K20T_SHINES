<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
         'username', 'password', 'status_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function representative(){
        return $this->hasOne('App\Representative', 'account_id', 'id');
    }
    public function student(){
        return $this->hasOne('App\Student', 'account_id', 'id');    
    }
    public function roles(){
        return $this->belongsToMany('App\Role', 'role_account', 'account_id', 'role_id')->withTimestamps();
    }

    public function isAdmin(){
        if($this->roles->first()->name == 'Admin' && $this->status_id==5){

            return true;
        }
        return false;
    }
    public function isRepresentative(){
        if($this->roles->first()->name == 'Representative' && $this->status_id==5){

            return true;
        }
        return false;
    }
    public function isStudent(){
        if($this->roles->first()->name == 'Student' && $this->status_id==5){

            return true;
        }else{
            return false;
        }
        
    }


    // public function getUsernameAttribute($value){
    //     return $this->student;
    // }

    //     public function company(){
    //     return $this->belongsTo('App\Company', 'App\Representative', 'account_id' ,'company_id', 'id');
    // }
}
