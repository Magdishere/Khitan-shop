<?php

namespace App\Models\admin;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Category extends Model implements \Astrotomic\Translatable\Contracts\Translatable
{

    use HasFactory;
    use Translatable;

    protected $table = 'categories';
    public $translatedAttributes = ['name'];
    protected $fillable = ['parent_id', 'slug', 'image_path', 'is_popular', 'name'];

    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'category_sales');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
