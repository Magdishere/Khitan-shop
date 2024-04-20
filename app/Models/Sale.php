<?php

namespace App\Models;

use App\Models\admin\Category;
use App\Models\admin\CategorySale;
use App\Models\admin\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded = [];

    public function getBannerAttribute()
    {
        // Assuming there is an 'image' column in the 'sales' table
        $imagePath = 'admin-assets/uploads/images/sales/' . $this->attributes['banner'];

        return asset($imagePath);
    }
    public function specificSale($type)
    {
        // Assuming you have a 'type' column in the 'sales' table
        $modelClassName = 'Sales' . ucfirst(strtolower($type));

        // Assuming the specific sale table has a 'sale_id' foreign key
        return $this->hasOne("App\Models\{$modelClassName}", 'sale_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'sale_product');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_sales');
    }
//    public function getProductsAttribute()
//    {
//        return $this->products()->where('category_id', $this->categories->first()->id)->get();
//    }

    public function categorySales()
    {
        return $this->hasMany(CategorySale::class);
    }

    public function isFlashSaleActive()
    {
        return $this->is_flash_sale ? 'Flash Sale' : 'Not Flash Sale';
    }


     public function isActive()
    {
        return $this->is_active ? 'Active' : 'Inactive';
    }

    public function scopeActiveSales($query)
    {
        return $query->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->where('is_active', true);
    }
    public function scopeActiveFlashSales($query)
    {
        return $query->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->where('is_active', true)
            ->where('is_flash_sale', true);
    }


}
