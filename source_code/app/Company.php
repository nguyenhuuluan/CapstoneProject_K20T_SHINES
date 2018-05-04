<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
class Company extends Model
{
    //
    protected $path = '/images/companies/logos/';
    protected $fillable = ['name', 'website', 'email', 'phone', 'working_day', 'status_id', 'logo','field','code_business','slug','is_hot'];
    
    // protected $with = ['address.district.city'];

    use Sluggable;
    use SluggableScopeHelpers;



    public function sluggable()
    {
        return [
            'slug' => [
                'source'        => 'name',
                'onUpdate'      => true,
            ]
        ];
    }

    public function path(){
       return "../companies/{$this->slug}";
         // host
         // return "../recruitments/{$this->slug}";
   }
   public function address(){
       return $this->hasOne('App\Address');
   }
   public function recruitments(){
       return $this->hasMany('App\Recruitment');
   }

   public function status(){
       return $this->belongsTo('App\Status');
   }

   public function tags()
   {
    return $this->belongsToMany('App\Tag', 'tag_company', 'company_id','tag_id')->withTimestamps();
}

public function photos()
{
    return $this->belongsToMany('App\Photo', 'photo_company', 'company_id', 'photo_id')->withTimestamps();
}

public function sections()
{
    return $this->belongsToMany('App\Section', 'section_company', 'company_id','section_id')->withPivot('content')->withTimestamps();
}

public function representatives(){
    return $this->hasMany('App\Representative');
}

public function getLogoAttribute($value){
    if($value){
        return $this->path.$value;
    }else{
        return $this->path.$value.'logo-default.jpg';
    }

}

public function socialNetworks(){
    return $this->hasMany('App\CompaniesSocialNetwork');
}
}	
