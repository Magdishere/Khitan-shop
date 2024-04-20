<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeOption extends Model
{
    use HasFactory;

    protected $table = 'product_attribute_options';

    protected $fillable = ['product_id', 'attribute_option_id', 'is_default', 'price'];
    protected $primaryKey = ['product_id', 'attribute_option_id'];

    public static function getAttributeOptionIdsByProductId($productId)
    {
        $productAttributeOptions = static::where('product_id', $productId)->get();
        return $productAttributeOptions->pluck('attribute_option_id')->toArray();
    }
}
