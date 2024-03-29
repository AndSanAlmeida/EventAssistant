<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Role;
use App\Event;
use App\Transaction;

class User extends Authenticatable
{
    use Notifiable;

    public function profileImage()
    {   
        if (str_contains($this->avatar, 'https://lh3.googleusercontent.com')) {
            $avatarPath = asset($this->avatar);
        } else {
            $avatarPath = ($this->avatar) ? '/storage/'.$this->avatar : '/img/default-avatar.png';
        }
        return $avatarPath;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'google_id', 'email', 'password', 'avatar',
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

    public function events() {
        return $this->hasMany(Event::class)->orderBy('created_at', 'DESC');
    }

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }

    // Verifica se os utilizadores têm Roles (Passa um Array com a Roles)
    public function hasAnyRoles($roles) {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    // Verifica se um utilizador tem uma Role (Passa apenas uma Role)
    public function hasAnyRole($role) {
        return null !== $this->roles()->where('name', $role)->first();
    }

    // Devolve todos os Eventos do User
    public function getUserEvents() {
        $getUserEvents = Event::select('user_id')->where('user_id', $this->id)->get();
        return $getUserEvents;
    }
}
