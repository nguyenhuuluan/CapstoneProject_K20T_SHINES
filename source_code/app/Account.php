<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Account extends Authenticatable
{
  use Notifiable;

  public $timestamps = true;

  protected $fillable = [
   'username', 'password', 'status_id', 'remember_token'
 ];
 // protected $with = ['roles'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'password', 'remember_token',
    ];



    //Send password reset notification
    public function sendPasswordResetNotification($token)
    {
      $this->notify(new AccountResetPasswordNotification($token));
    }


    public function representative(){
      return $this->hasOne('App\Representative', 'account_id', 'id');
    }
    public function student(){
      return $this->hasOne('App\Student', 'account_id', 'id');    
    }
    public function staff(){
      return $this->hasOne('App\Staff', 'account_id', 'id');    
    }
    public function roles(){
      return $this->belongsToMany('App\Role', 'role_account', 'account_id', 'role_id')->withTimestamps();
    }
    public function blogs()
    {
      return $this->hasMany('App\Blog');
    }
    public function status()
    {
      return $this->hasOne('App\Status');
    }
    public function permissions()
    {
      return $this->belongsToMany('App\Permission', 'permission_account', 'account_id', 'permission_id')->withTimestamps();
    }


    public function isAdmin(){
      if($this->status_id==5)
      {
        foreach ($this->roles->pluck('name')->all() as $key => $value) 
        {
          if($value == 'Admin' || $value =='Staff')
            {return true;}
          else
            {return false;}
        }
      }
      else
        {return false;}
    }
    public function isRepresentative(){
      if($this->status_id==5)
      {
        foreach ($this->roles->pluck('name')->all() as $key => $value) 
        {
          if($value == 'Representative')
            {return true;}
          else
            {return false;}
        }
      }
      else
        {return false;}
    }

    public function isStudent(){
      if($this->status_id==5)
      {
        foreach ($this->roles->pluck('name')->all() as $key => $value) 
        {
          if($value == 'Student')
            {return true;}
          else
            {return false;}
        }
      }
      else
        {return false;}
    }


    // public function getUsernameAttribute($value){
    //     return $this->student;
    // }

    //     public function company(){
    //     return $this->belongsTo('App\Company', 'App\Representative', 'account_id' ,'company_id', 'id');
    // }
  }

