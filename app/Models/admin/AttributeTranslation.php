<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
}
