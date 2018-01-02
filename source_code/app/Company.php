<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $path = '/images/companies/logos/';
    protected $fillable = ['name', 'website', 'email', 'phone', 'working_day', 'status_id', 'logo'];

    public function address(){
    	return $this->hasOne('App\Address');
    }
    public function recruitments(){
    	return $this->hasMany('App\Recruitment');
    }

    public function status(){
    	return $this->belongsTo('App\Status');
    }
<<<<<<< HEA

    public function representatives(){
        return $this->hasMany('App\Representative');
=======
    public function representative(){
        return $this->hasOne('App\Representative', 'company_id', 'id');
    }
    public function getLogoAttribute($value){
        return $this->path.$value;
>>>>>>> master
    }
}	
