<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'fullname',
        'email',
        'pass',
        'openid'
    ];

    protected $hidden = [
        'pass'
    ];

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'update_date';

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user', 'id');
    }
}
