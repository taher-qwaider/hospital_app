<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $appends = ['full_path'];


    public function getFullPathAttribute(){
        return isset($this->path) ? asset('/storage/'.$this->path) : asset('storage/images/avatar.png');
    }
}
