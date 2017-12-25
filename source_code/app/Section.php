<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $fillable = ['title'];

    public function recruitments(){
    	return $this->belongsToMany('App\Recruitment');
    }
    public function companies(){
    	return $this->belongsToMany('App\Company');
    }
}
