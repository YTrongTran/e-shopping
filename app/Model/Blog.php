<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';
    protected $fillable = ['name', 'image_blog', 'description', 'user_id', 'deleted_at', 'updated_at'];
}