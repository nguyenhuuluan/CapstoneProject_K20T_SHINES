<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $fillable = ['address', 'latitude', 'longtitude', 'company_id'];

    public function district(){
    	return $this->belongsTo('App\District');
    }
    public function company(){
    	return $this->belongsTo('App\Company');
    }
}
