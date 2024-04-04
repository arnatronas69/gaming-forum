<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'body', 'user_id'];
    
    public function posts()
{
    return $this->hasMany(Post::class);
}

public function user()
    {
        return $this->belongsTo(User::class);
    }
}

