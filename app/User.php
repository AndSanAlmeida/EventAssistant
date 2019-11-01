<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Role;
use App\Event;

class User extends Authenticatable
{
    use Notifiable;

    public function profileImage()
    {   
        $avatarPath = ($this->avatar) ? '/storage/'.$this->avatar : '/img/avatar/default-avatar.png';
        return $avatarPath;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar',
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

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    // Verifica se os utilizadores têm Roles (Passa um Array com a Roles)
    public function hasAnyRoles($roles) {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    // Verifica se um utilizador tem uma Role (Passa apenas uma Role)
    public function hasAnyRole($role) {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function events() {
        return $this->hasMany(Event::class)->orderBy('created_at', 'DESC');
    }
}
