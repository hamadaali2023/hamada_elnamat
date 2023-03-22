<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultingJoined extends Model
{
    protected $table = 'consulting_joined';

    public function courses()
    {
        return $this->belongsTo(Course::class, 'courseId', 'id');
    }
    
    public function lives()
    {
        return $this->belongsTo(Live::class, 'liveId', 'id');
    }
}
