<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlidesTranslation extends Model
{
    use HasFactory;

    protected $table = 'slides_translations';
    protected $fillable = ['title', 'description', 'link', 'image'];
    public $timestamps = false;
}
