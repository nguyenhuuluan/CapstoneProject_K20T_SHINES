<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

//Trait for sending notifications in laravel
use Illuminate\Notifications\Notifiable;

//Notification for account
use App\Notifications\SellerResetPasswordNotification;

// class Account extends Model
class Account extends Authenticatable
{
    // This trait has notify() method defined
    use Notifiable;

    public $timestamps = true;

    protected $fillable = [
       'username', 'password', 'status_id'
   ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    // Send password reset notification
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AccountResetPasswordNotification($token));
    }
}
