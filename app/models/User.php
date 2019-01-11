<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table = 'users';
    
    protected $fillable = [
        'username',
        'password'
    ];

    public $validate = [
        'username' => 'required',
        'password' => 'required',
    ];

    public $message = [
        'username.required' => 'Username is required',
        'password.required' => 'Password is required'
    ];
}