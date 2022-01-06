<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Teacher extends Authenticatable
{
    use HasFactory, SoftDeletes, HasApiTokens, HasRoles;
    protected $with = ['city', 'image'];
    protected $hidden =['password'];
    protected $appends = ['level'];

    /**
     * Find the user instance for the given username.
     *
     * @param  string  $username
     * @return \App\Models\User
     */
    public function getLevelAttribute(){
        return $this->teach_level;
    }
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
    public function users(){
        return $this->hasMany(User::class);
    }
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
