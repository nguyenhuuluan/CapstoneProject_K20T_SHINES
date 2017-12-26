<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    //

    protected $fillable = ['title','salary','number_of_view','expire_date','is_hot','company_id','status_id'];


    public function company(){
    	return $this->belongsTo('App\Company');
    	//return $this->belongsTo('App\Company', 'company_id', 'id');
    }

    public function status(){
    	return $this->belongsTo('App\Status');
    }
    public function sections(){
    	return $this->belongsToMany('App\Section', 'section_recruitment', 'recruitment_id','section_id')->withPivot('content');
    }
    public function categories(){
    	return $this->belongsToMany('App\Category');
    }
}
