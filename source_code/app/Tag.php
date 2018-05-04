<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = ['name'];
    
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
        $hasOne = new HasOne(
            (new Recruitment())->newQuery(),
            $this->newPivot(
                new Tag(),
                [],
                'tag_recruitment', // the pivot table between recruitments and tags
                false
            ),
                'recruitment_id', // the foreign key in the pivot table
                'id' // the primary key in tag table
            );
        $hasOne->getQuery()->from('tag_recruitment'); // It currently changes the query of $hasOne
        return $hasOne->selectRaw("tag_id,count(*) as aggregate")->groupBy("tag_id");
    }

    public function getRecruitmentCountAttribute() {
    // if relation is not loaded already, let's do it first
        if (!array_key_exists('recruitmentCount', $this->relations)) {
            $this->load('recruitmentCount');
        }

        $related = $this->getRelation('recruitmentCount');

    // then return the count directly
        return ($related) ? (int)$related->aggregate : 0;
    }
}
