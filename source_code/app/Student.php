<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $fillable = ['name','gender','email','phone','profile_photo','dateofbirth','account_id','faculty_id'];

    protected $timestamp = true;

}
