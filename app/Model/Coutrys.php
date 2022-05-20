<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Coutrys extends Model
{
    protected $table = 'coutrys';
    protected $fillable = ['name', 'deleted_at', 'updated_at'];
}