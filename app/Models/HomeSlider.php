<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class HomeSlider extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable = [
        'title', 'big-title', 'description', 'link', 'image_path', 'status'
    ];

     // 3. To define which attributes needs to be translated
    public $translatedAttributes = ['title', 'big-title', 'description', 'link'];
}
