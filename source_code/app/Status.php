<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
	protected $fillable = ['name','type'];


	public function recruitments(){
		return $this->hasMany('App\Recruitment');
	}
	public function companies(){
		return $this->hasMany('App\Compant');
	}
	public function accounts(){
		return $this->hasMany('App\Account');
	}

}
