<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';
    protected $fillable = ['name', 'display_name', 'deleted_at'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permissions_role', 'role_id', 'permissions_id',)->withTimestamps();
    }
}