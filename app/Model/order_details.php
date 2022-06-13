<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    protected $table = 'order_details';
    protected $guarded = [];

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}