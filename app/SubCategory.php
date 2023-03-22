<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SubCategory extends Model
{
    protected $table = 'sub_categories';

    use HasTranslations;
    public $translatable = ['title'];
    // public function categories()
    // {
    //     return $this->belongsTo(Category::class);
    // }
}
