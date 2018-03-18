<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $path = '/images/students/avatas/';
    protected $fillable = ['name','description','gender','email','phone','photo','dateofbirth','account_id','faculty_id'];


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

    public function listTags()
    {
        return $this->belongsToMany('App\Tag', 'tag_student', 'student_id','tag_id')->withTimestamps()->withPivot('student_id');

    }
    public function experiences()
    {
        return $this->hasMany('App\Experience');
    }
    public function skills()
    {
        return $this->hasMany('App\Skill');
    }

        public function getPhotoAttribute($value){
        if($value){
            return $this->path.$value;
        }else{
            return 'http://via.placeholder.com/1205x1795';
        }
    }

}
