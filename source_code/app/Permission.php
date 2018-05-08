<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //


    public function accounts()
    {
      return $this->belongsToMany('App\Account', 'permission_account', 'permission_id', 'account_id')->withTimestamps();
    }
}
