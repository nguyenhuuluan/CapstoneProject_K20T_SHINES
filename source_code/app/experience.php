<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    //
    protected $fillable = ['title', 'role', 'from', 'to', 'student_id'];


    public function student()
    {
    	return $this->belongsTo('App\Student');
    }
}
