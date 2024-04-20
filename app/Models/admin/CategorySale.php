<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;

class CategorySale extends Model
{
    use HasFactory;

    protected $table = 'category_sales';
    protected $fillable = ['category_id', 'sale_id'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
