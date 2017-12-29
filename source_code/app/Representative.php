<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    //
    protected $fillable = ['name','phone','email','account_id','company_id'];

}
