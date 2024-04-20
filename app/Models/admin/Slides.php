<?php

namespace App\Models\admin;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slides extends Model implements \Astrotomic\Translatable\Contracts\Translatable
{
    use HasFactory;
    use Translatable;

    protected $fillable = ['image'];
    public $translatedAttributes = ['title', 'description', 'link'];
}
