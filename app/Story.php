<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Story extends Model
{

    protected $table = 'books';

    use Sluggable;
    protected $fillable = [
       'name', 'slug',
    ];

    // protected $guarded=[];


    public function sluggable(){
        return [
          'slug' => [
              'source' => 'name'
        ]
    ];
    }
}
