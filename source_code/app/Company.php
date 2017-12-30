<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable = ['name', 'website', 'email', 'phone', 'working_day', 'status_id'];


    public function address(){
    	return $this->hasOne('App\Address');
    }
    public function recruitments(){
    	return $this->hasMany('App\Recruitment');
    }

    public function status(){
    	return $this->belongsTo('App\Status');
    }
    public function representative(){
        return $this->hasOne('App\Representative', 'company_id', 'id');
    }
}	
