<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    protected $fillable = ['title', 'content', 'account_id'];


    public function owner()
    {
    	return $this->belongsTo('App\Account', 'account_id');
    }
}
