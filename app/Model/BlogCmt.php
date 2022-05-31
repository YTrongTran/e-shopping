<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BlogCmt extends Model
{
    protected $table = 'blog_cmts';
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function childsBlog()
    {
        return $this->hasMany(BlogCmt::class, 'level')->latest();
    }
}