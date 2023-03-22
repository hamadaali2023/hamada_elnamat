<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function courses_joined()
    {
      return $this->hasMany(Courses_joined::class,'courseId','id');
    }
    
    // public function views()
    // {
    //      return $this->hasMany('App\View', 'courseId', 'id');
    // }
    public function views()
    {
      return $this->hasMany(View::class,'courseId','id');
    }
    
}
