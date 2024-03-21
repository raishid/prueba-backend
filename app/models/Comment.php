<?php

namespace App\models;

use App\models\User;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    protected $table = 'user_comments';

    protected $fillable = [
        'coment_text',
        'likes',
        'user'
    ];

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'update_date';


    public function userComment()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}
