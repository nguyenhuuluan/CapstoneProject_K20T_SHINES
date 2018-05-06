<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = ['name'];
    // protected $with = ['address.district.city'];
    
    
    public function recruitments(){
    	return $this->belongsToMany('App\Recruitment', 'tag_recruitment' ,'tag_id', 'recruitment_id');
    }
    public function companies(){
    	return $this->belongsToMany('App\Company', 'tag_company','tag_id', 'company_id');
    }
    public function students(){
    	return $this->belongsToMany('App\Student', 'tag_student' ,'tag_id', 'student_id');
    }
    public function blogs(){
    	return $this->belongsToMany('App\Blog', 'tag_blog' ,'tag_id', 'blog_id');
    }
    public function faculties(){
    	return $this->belongsToMany('App\Faculty', 'tag_faculty' ,'tag_id', 'faculty_id');
    }

    public function recruitmentCount() {
     return $this->belongsToMany('App\Recruitment', 'tag_recruitment' ,'tag_id', 'recruitment_id')->selectRaw('count(recruitment.id) as aggregate');
 }

 public function getConnectorsCountAttribute()
 {
    if ( ! array_key_exists('recruitmentCount', $this->relations)) $this->load('recruitmentCount');

    $related = $this->getRelation('recruitmentCount')->first();

    return ($related) ? $related->aggregate : 0;
}


}
