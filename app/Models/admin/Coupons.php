<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount',
        'max_value',
        'uses',
        'max_uses',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
