<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
class Recruitment extends Model
{
    //
    use Sluggable;
    use SluggableScopeHelpers;
    protected $fillable = ['title','salary','number_of_view','number_of_anonymous_view','expire_date','is_hot','company_id','status_id', 'slug', 'location', 'searching'];

    // protected $with = ['categories', 'company', 'tags'];

    public function sluggable()
    {   
        return [
            'slug' => [
                'source'        => 'title',
                'onUpdate'      => true,
            ],
            'searching'=>[
                'source'        => ['title','created_at','company.name','searching'],
                'onUpdate'      => true,
            ],
        ];
    }

     public function getSearchingAttribute() {
        $tmp = array();
        foreach ($this->tags as $tag) {
            $tmp[] = $tag->name;
        }
        return implode(" ",$tmp);
    }

    public function path(){
         return "../recruitments/{$this->slug}";
         // host
         // return "../recruitments/{$this->slug}";
    }
    public function company(){
    	return $this->belongsTo('App\Company');
    	//return $this->belongsTo('App\Company', 'company_id', 'id');
    }

    public function status(){
    	return $this->belongsTo('App\Status');
    }
    public function sections(){
        return $this->belongsToMany('App\Section', 'section_recruitment', 'recruitment_id','section_id')->withPivot('content')->withTimestamps();
    }
    public function students(){
    	return $this->belongsToMany('App\Student', 'apply', 'recruitment_id','student_id')->withPivot('cv_id', 'description')->withTimestamps();
    }
    public function saves(){
        return $this->belongsToMany('App\Student', 'student_recruitment', 'recruitment_id','student_id')->withTimestamps();
    }
    public function categories(){
    	return $this->belongsToMany('App\Category', 'category_recruitment', 'recruitment_id', 'category_id')->withTimestamps();
    }
    public function tags(){
        return $this->belongsToMany('App\Tag', 'tag_recruitment', 'recruitment_id', 'tag_id')->withTimestamps();
    }
}
