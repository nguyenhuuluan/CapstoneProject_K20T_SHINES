<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

//Trait for sending notifications in laravel
use Illuminate\Notifications\Notifiable;

//Notification for Seller
use App\Notifications\AccountResetPasswordNotification;

class Account extends Model
{

 // use Notifiable;

  public $timestamps = true;

  protected $fillable = [
   'username', 'password', 'status_id', 'remember_token'
 ];

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
    //     public function company(){
    //     return $this->belongsTo('App\Company', 'App\Representative', 'account_id' ,'company_id', 'id');
    // }
}

