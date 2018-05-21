<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
class Blog extends Model
{
    //
    use Sluggable;
    use SluggableScopeHelpers;
    protected $fillable = ['title', 'content', 'account_id', 'slug', 'photo','description'];
    protected $path = '/blogs/ava/';
    protected $with = ['tags'];

    public function sluggable()
    {   
        return [
            'slug' => [
                'source'        => 'title',
                'onUpdate'      => true,
            ],
        ];
    }


    public function owner()
    {
    	return $this->belongsTo('App\Account', 'account_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tag_blog', 'blog_id', 'tag_id')->withTimestamps();
    }

    public function photos()
    {
    	return $this->belongsToMany('App\Photo', 'photo_blog', 'blog_id', 'photo_id')->withTimestamps();
    }

    public function getPhotoAttribute($value){
            return $this->path.$value;
    }
}
