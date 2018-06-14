<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
class Blog extends Model
{
    //
    use Sluggable;
    use SluggableScopeHelpers;
    protected $fillable = ['title', 'content', 'account_id', 'slug', 'photo','description'];
    protected $path = '/blogs/ava/';
    protected $with = ['tags'];

    public function sluggable()
    {   
        return [
            'slug' => [
                'source'        => 'title',
                'onUpdate'      => true,
            ],
        ];
    }

    public function getHeaderAttribute(){
        $limit = 15;
        $str_s ='';
        if(stripos($this->title," ")){
            $ex_str = explode(" ",$this->title);
            if(count($ex_str)>$limit){
                for($i=0;$i<$limit;$i++){
                   $str_s.=$ex_str[$i]." ";
               }
               return $str_s.'...';
           }else{return $this->title;}
       }else{return $this->title;}
   }
   public function owner()
   {
     return $this->belongsTo('App\Account', 'account_id');
 }

 public function tags()
 {
    return $this->belongsToMany('App\Tag', 'tag_blog', 'blog_id', 'tag_id')->withTimestamps();
}

public function photos()
{
 return $this->belongsToMany('App\Photo', 'photo_blog', 'blog_id', 'photo_id')->withTimestamps();
}

public function getPhotoAttribute($value){
    return $this->path.$value;
}

public function getCreatedAtAtrribute(){
        \Carbon\Carbon::setLocale('vi');
        return $this->created_at->diffForHumans();
    }
}
