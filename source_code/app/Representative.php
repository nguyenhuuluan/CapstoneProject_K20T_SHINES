<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    //
    protected $fillable = ['name','phone','email','account_id','company_id', 'position'];

    public function account(){
        return $this->belongsTo('App\Account', 'account_id', 'id');
    }
    public function company(){
    	return $this->belongsTo('App\Company', 'company_id', 'id');
    }
}
