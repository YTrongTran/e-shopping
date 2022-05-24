<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $guarded = [];
    public function childs()
    {
        return $this->hasMany(Permission::class, 'parent_id');
    }
}