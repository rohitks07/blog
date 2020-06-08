<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Role;
use App\Profile;
use App\Country;
use App\State;
use App\City;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $dates  =['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','role_id'
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

    //role table to user
    public function role(){
        return $this->belongsTo('App\Role');
    }

    //relationship user and profile
    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    //short name for country
    public function getCountry(){
        return $this->profile->country->name;
    }
    //short name for state
    public function getState(){
        return $this->profile->state->name;
    }
    //short name for city
    public function getCity(){
        return $this->profile->city->name;
    }
}
