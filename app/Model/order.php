<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $table = 'orders';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order_details()
    {
        return $this->hasMany(order_details::class, 'order_code');
    }
    public function shipping()
    {
        return $this->belongsTo(shipping::class, 'shipping_id');
    }
}