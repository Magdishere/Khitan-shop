<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSliderTranslations extends Model
{
    use HasFactory;


    protected $fillable = ['title', 'big-title', 'description', 'link', 'image_path', 'status'];
    public $timestamps = false;
}

