<?php

namespace App\Models\admin;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['name'];

    public function options()
    {
        return $this->hasMany(AttributeOption::class);
    }
}
