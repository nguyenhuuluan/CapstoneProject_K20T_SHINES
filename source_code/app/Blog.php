<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    protected $fillable = ['title', 'content', 'account_id'];


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
}
