<?php

namespace App\Models\Models\Logins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class SecurityLogin extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phoneno',
        'email',
        'gender',
        'password'
    ];
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
