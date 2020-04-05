<?php

namespace App;

use Mexitek\PHPColors\Color;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
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

    protected $appends = ['background_color'];

    public function components()
    {
        return $this->hasMany(Component::class);
    }

    public function getBackgroundColorAttribute()
    {
        $c = substr(md5($this->first_name . $this->last_name), 2, 6);
        while ((new Color($c))->isLight()) {
            $c = (new Color($c))->darken(10);
        }

        return '#' . $c;
    }
}
