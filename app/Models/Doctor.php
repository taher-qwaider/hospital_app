<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['image'];

    public function getGenderAttribute($gender){
        return (($gender == 'M') ? 'Male' : 'Female');
    }

    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }
    public function image(){
        return $this->morphOne(Image::class, 'object');
    }
}
