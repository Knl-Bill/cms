<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;
    protected $fillable = [
        'rollno',
        'name',
        'phoneno',
        'email',
        'course',
        'batch',
        'department',
        'gender',
        'hostelname',
        'roomno',
        'password'
    ];
    public function setPasswordAttribute($value)
    {
    $this->attributes['password'] = bcrypt($value);
    }
}
