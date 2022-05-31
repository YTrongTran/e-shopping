<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';
    protected $guarded  = [];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comment()
    {
        return $this->hasMany(BlogCmt::class, 'blog_id')->where('level', 0)->latest();
    }
}