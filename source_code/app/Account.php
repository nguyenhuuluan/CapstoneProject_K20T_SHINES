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

    public function representative(){
        return $this->hasOne('App\Representative', 'account_id', 'id');
    }
    //     public function company(){
    //     return $this->belongsTo('App\Company', 'App\Representative', 'account_id' ,'company_id', 'id');
    // }
}
