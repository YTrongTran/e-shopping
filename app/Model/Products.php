<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table  = 'products';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function product()
    {
        return $this->hasMany(Products_Image::class, 'product_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'product_tag', 'product_id', 'tag_id')->withTimestamps();
    }
}