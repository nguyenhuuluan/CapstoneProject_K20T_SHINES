<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{


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
}
