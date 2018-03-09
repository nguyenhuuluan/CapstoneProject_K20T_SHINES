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

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tag_company', 'company_id','tag_id')->withTimestamps();
    }

    public function sections()
    {
        return $this->belongsToMany('App\Section', 'section_company', 'company_id','section_id')->withPivot('content')->withTimestamps();
    }

    public function representatives(){
        return $this->hasMany('App\Representative');
    }
    
    public function getLogoAttribute($value){
        if($value){
            return $this->path.$value;
        }else{
            return 'http://via.placeholder.com/100x100';
        }
    }
}	
