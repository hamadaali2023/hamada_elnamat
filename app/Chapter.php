<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    public function videos()
    {
      return $this->hasMany(Video::class,'chapterId','id');
    }
}
