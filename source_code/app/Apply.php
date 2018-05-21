<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    //
    protected $fillable = ['student_id','recruitment_id','cv_id','description'];


    public function student()
    {
        return $this->belongsTo('App\Student');
    }
    public function recruitment()
    {
        return $this->belongsTo('App\Recruitment');
    }
    public function cv()
    {
        return $this->belongsTo('App\Cv');

    }
}
