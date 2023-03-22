<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{

    use Notifiable;
    use HasRoles;
    // use Notifiable;

    
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    

    protected $fillable = [
        'name', 'email', 'password','roles_name','Status','photo','mobile','address'
    ];
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
    'password', 'remember_token',
    ];
    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
    'email_verified_at' => 'datetime',
    'roles_name' => 'array',

    ];


    
}
