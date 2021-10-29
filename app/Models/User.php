<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user',
        'lname',
        'fname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getProfilePicAttribute() {
        $path = "img/profile-pics/$this->id.jpg";
        $file = public_path($path);
        if(file_exists($file)) {
            return asset($path);
        }else {
            return asset('img/undraw_profile.svg');
        }
    }

    public function getFullNameAttribute() {
        return "$this->lname, $this->fname";
    }

    public function userRoles() {
        return $this->hasMany('App\Models\UserRole')->with('role');
    }

    public function userPermissions() {
        return $this->hasMany('App\Models\UserPermission')->with('permission');
    }

    public function is($roleName) {
        foreach($this->userRoles as $userRole) {
            if($roleName == $userRole->role->role) {
                return true;
            }
        }
        return false;
    }

    public function isOnly($roleName) {
        $roleCount = count($this->userRoles);

        return ($roleCount==1 && strcasecmp($this->userRoles[0]->role->role, $roleName)==0);
    }

    public function may($permissionName) {
        foreach($this->userPermissions as $perms) {
            if(strcasecmp($permissionName, $perms->permission->permission) === 0 ) {
                return true;
            }
        }

        return false;
    }

    public function teacherAccount() {
        return $this->hasOne('App\Models\Teacher');
    }
}
