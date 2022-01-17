<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, SoftDeletes, HasRoles, HasApiTokens;
    protected $with = ['image', 'city'];
    /**
     * Find the user instance for the given username.
     *
     * @param  string  $username
     * @return \App\Models\User
     */
    public function findForPassport($username)
    {
        return $this->where('id', $username)->first();
    }
    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }

    public function image(){
        return $this->morphOne(Image::class, 'object');
    }

    public function city(){
        return $this->belongsTo(City::class);
    }
//    public function users(){
//        return $this->hasManyThrough(User::class, Teacher::class);
//    }
//    public function teachers(){
//        return $this->hasMany(Teacher::class);
//    }
//    public function posts(){
//        return $this->hasMany(Post::class);
//    }
}
