<?php

namespace App\Models\admin;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
    use HasFactory, Translatable;

    protected $guarded = [];
    public $translatedAttributes = ['name'];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
    public function options()
    {
        return $this->hasMany(AttributeOption::class);
    }
}
