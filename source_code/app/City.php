<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    protected $fillable = ['name', 'country_id'];

    public function districts(){
    	return $this->hasMany('App\District');
    }

    public function country(){
    	return $this->belongsTo('App\Country');
    }

}
