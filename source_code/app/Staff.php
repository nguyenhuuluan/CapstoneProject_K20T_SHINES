<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    //
    protected $fillable = ['name','phone','email','account_id'];

    public function account()
    {
    	return $this->belongsTo('App\Account');
    }
}
