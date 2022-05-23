<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $guarded = [];

    //quan hệ 1 nhiều
    public function categoryChilds()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}