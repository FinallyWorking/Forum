<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    public function parent()
    {
        return $this->belongsTo(Forum::class);
    }

    public function child()
    {
        return $this->hasMany(Forum::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function threads()
    {
        return $this->hasMany(Post::class)->whereNull('reply_id');
    }
}
