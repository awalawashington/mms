<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'DESC');
    }
    public function likes()
    {
        return $this->hasMany(Like::class)->where('like', '=', TRUE)->orderBy('created_at', 'DESC');
    }
}
