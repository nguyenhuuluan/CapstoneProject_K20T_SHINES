<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = ['name'];

    public function accounts(){
        return $this->belongsToMany('App\Account', 'role_account', 'role_id', 'account_id')->withTimestamps();
    }
}
