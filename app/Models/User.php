<?php

namespace MailLight\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, UuidForKey;
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function roles()
    {
        return $this->belongsToMany(MailLight\Models\Role::class);
    }

    public function hasRole($role)
    {
        if (is_string($role))
        {
            return $this->roles->contains('name', $role);
        }
        return !! $role->intersect($this->roles)->count();
    }
}
