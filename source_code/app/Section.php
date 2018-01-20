<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $fillable = ['title', 'type'];

    public function recruitments(){
    	return $this->belongsToMany('App\Recruitment', 'section_recruitment', 'section_id','recruitment_id')->withPivot('content')->withTimestamps();
    }
    public function companies(){
    	return $this->belongsToMany('App\Company', 'section_company', 'section_id','company_id')->withPivot('content')->withTimestamps();

    }
}
