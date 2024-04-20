<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Strings extends Model
{
    use HasFactory;

    protected $fillable = ['brand', 'material', 'length', 'color', 'weight', 'image'];

}
