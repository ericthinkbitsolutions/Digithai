<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    public const PATH_PREFIX = 'public/users';

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class, 'user_id', 'id');
    }
}
