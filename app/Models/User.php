<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];

    protected $with = ['image', 'city', 'teacher'];
    protected $appends = ['full_name'];

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
    /**
     * Find the user instance for the given username.
     *
     * @param  string  $email
     * @return \App\Models\User
     */
    public function findForPassport($email)
    {
        return $this->where('email', $email)->first();
    }
    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }

    public function image(){
        return $this->morphOne(Image::class,'object');
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
//    public function admin(){
//        return $this->hasOneThrough(Admin::class, Teacher::class);
//    }
    public function homeWorks(){
        return $this->hasMany(HomeWork::class, 'user_id', 'id');
    }
}
