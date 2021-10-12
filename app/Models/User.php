<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Photo;
use App\Models\Country;
use App\Models\CodeUser;
use App\Models\WorldCountry;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'address',
        'role',
        'bio',
        'dob',
        'height',
        'weight',
        'color',
        'gender',
        'marital_status',
        'nationality',
        'active',
        'profile',
        'password'
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date',
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class)->orderBy('created_at', 'DESC');;
    }
    public function likes()
    {
        return $this->hasMany(Like::class)->orderBy('created_at', 'DESC');;
    }

    public function code()
    {
        return $this->hasOne(CodeUser::class);
    }

    public function country()
    {
        return $this->hasOne(WorldCountry::class, 'id' , 'nationality');
    }
    
}
