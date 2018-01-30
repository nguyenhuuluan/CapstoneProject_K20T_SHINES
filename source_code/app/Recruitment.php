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
    protected $fillable = ['title','salary','number_of_view','expire_date','is_hot','company_id','status_id', 'slug'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source'        => 'title',
                'onUpdate'      => true,
            ]
        ];
    }
    public function path(){
         return "/recruitments/{$this->slug}";
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
    public function categories(){
    	return $this->belongsToMany('App\Category', 'category_recruitment', 'recruitment_id', 'category_id')->withTimestamps();
    }
    public function tags(){
        return $this->belongsToMany('App\Tag', 'tag_recruitment', 'recruitment_id', 'tag_id')->withTimestamps();
    }
}
