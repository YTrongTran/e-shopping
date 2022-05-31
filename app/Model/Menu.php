<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $guarded  = [];

    public function childsMenu()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}