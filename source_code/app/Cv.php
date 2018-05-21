<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    //
	protected $fillable = ['name', 'file', 'student_id'];


	public function student()
	{
		return $this->belongsTo('App\Student');
	}

	public function recruitments()
	{
		return $this->belongsToMany('App\Recruitment', 'applies', 'cv_id', 'recruiment_id')->withTimestamps()->withPivot(['description', 'student_id']);;
	}
	
}
