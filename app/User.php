<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'email', 'phone', 'status', 'dob', 'bio', 'country', 'gender'];
}
