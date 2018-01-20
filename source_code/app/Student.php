<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $fillable = ['name','gender','email','phone','profile_photo','dateofbirth','account_id','faculty_id'];

    public $timestamp = true;

    public function faculty()
    {
    	return $this->belongsTo('App\Faculty');
    }
    public function account()
    {
    	return $this->belongsTo('App\Account');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tag_student', 'student_id','tag_id')->withTimestamps();
    }


}
