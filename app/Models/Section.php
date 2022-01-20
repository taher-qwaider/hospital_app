<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function doctors(){
        $this->hasMany(Doctor::class);
    }


//    public function city(){
//        return $this->belongsTo(City::class);
//    }
    public function image(){
        return $this->morphOne(Image::class, 'object');
    }
}
