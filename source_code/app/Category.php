<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['name'];


    public function recruitments(){
    	return $this->belongsToMany('App\Recruitment');
    }

    public function getNameAttribute($value){
    	return strtoupper($value);
    }

    // public function setNameAttribute($value){
    // 	$this->attributes['name']= strtoupper($value);
    // }
}
