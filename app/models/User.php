<?php 

namespace App\models;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'username',
        'email',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }
}