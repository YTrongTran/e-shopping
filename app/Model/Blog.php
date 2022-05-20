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
}