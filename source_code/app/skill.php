<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //
    protected $fillable = ['name','rating','student_id'];

     public function student()
    {
    	return $this->belongsTo('App\Student');
    }
}
