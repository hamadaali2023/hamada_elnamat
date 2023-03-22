<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    
    public function chapters()
    {
        return $this->belongsTo(Chapter::class, 'chapterId', 'id');
    }
    // use Sluggable;
    // protected $fillable = [
    //    'name', 'slug',
    // ];

    // // protected $guarded=[];


    // public function sluggable(){
    //     return [
    //       'slug' => [
    //           'source' => 'name'
    //     ]
    // ];
    // }
}
