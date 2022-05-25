<?php

namespace App;

use App\Model\Coutrys;
use App\Model\Roles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address', 'country_id', 'avatar', 'avatar_path', 'deleted_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function country()
    {
        return $this->belongsTo(Coutrys::class, 'country_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'role_user', 'user_id', 'role_id')->withTimestamps();
    }
    public function checkPermissionAcces($check)
    {
        //kiểm tra user đang login hệ thống có những quyền gì
        $roles = auth()->user()->roles;
        foreach ($roles as $role) {
            $permissons = $role->permissions;
            if ($permissons->contains('key_code', $check)) {
                return true;
            }
        }
        return false;
    }
}