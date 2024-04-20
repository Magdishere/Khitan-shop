<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flash extends Model
{
    protected $fillable = ['sale_id', 'start_date', 'end_date', 'banner', 'position'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
