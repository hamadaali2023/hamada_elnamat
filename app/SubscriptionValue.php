<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class SubscriptionValue extends Model
{
    protected $table = 'subscription_values';
    public $translatable = ['type','value'];
    
}
