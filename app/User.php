<?php

namespace App;

use App\Http\AuthTraits\OwnsRecord;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable, OwnsRecord;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'is_admin', 'status_id', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function widgets()
    {
        return $this->hasMany('App\Widget');
    }

    public function isAdmin()
    {
        return Auth::user()->is_admin == 1;
    }

    public function isActiveStatus()
    {
        return Auth::user()->status_id == 10;
    }
}
