<?php

namespace App;

use App\Http\AuthTraits\OwnsRecord;
use App\Http\Requests\UserRequest;
use App\Traits\HasModelTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, OwnsRecord, HasModelTrait, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'is_subscribed', 'is_admin', 'status_id', 'password',
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

    public function socialProviders()
    {
        return $this->hasMany('App\SocialProvider');
    }

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function isAdmin()
    {
        return Auth::user()->is_admin == 1;
    }

    public function isActiveStatus()
    {
        return Auth::user()->status_id == 10;
    }

    public function updateUser($user, UserRequest $request)
    {
        return $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'is_subscribed' => $request->is_subscribed,
            'is_admin' => $request->is_admin,
            'status_id' => $request->status_id,
        ]);
    }

    public function showAdminStatusOf($user)
    {
        return $user->is_admin ? 'Yes' : 'No';
    }
    public function showNewsletterStatusOf($user)
    {
        return $user->is_subscribed == 1 ? 'Yes' : 'No';
    }
}
