<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    //
	protected $fillable = ['name','description'];

	public function students()
	{
		return $this->hasMany('App\Student');
	}
	public function tags()
	{
		return $this->belongsToMany('App\Tag', 'tag_faculty', 'faculty_id','tag_id')->withTimestamps();
	}
}
