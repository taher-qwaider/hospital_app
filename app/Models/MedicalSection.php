<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalSection extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $appends = ['image_path'];

    public function getImagePathAttribute(){

        return isset($this->image) ? $this->image->full_path : '';

    }
    public function image()
    {
        return $this->morphOne(Image::class, 'object');
    }
}
