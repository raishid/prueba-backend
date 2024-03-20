<?php 

namespace App\models;

use App\models\User;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'comment',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}