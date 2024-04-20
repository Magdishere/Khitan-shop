<?php

namespace App\Models\admin;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Category;
use Illuminate\Http\Request;

class Product extends Model implements \Astrotomic\Translatable\Contracts\Translatable
{

    use HasFactory;
    use \Astrotomic\Translatable\Translatable;
    protected $table = 'products';
    public $translatedAttributes = ['name', 'short_description', 'description'];
    protected $fillable = ['slug','regular_price', 'SKU', 'stock_status', 'featured', 'quantity', 'image','category_id'];
    public function category(){

        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'sale_product')->where('is_active', 1);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function categorySales()
    {
        return $this->hasManyThrough(CategorySale::class, Category::class);
    }
    public function getActiveSales()
    {
        return $this->sales()->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->where('is_active', true)
            ->get();
    }

    public function scopeSortBy($query, $sorting)
    {
        switch ($sorting) {
            case 'date':
                $query->orderBy('created_at', 'DESC');
                break;
            case 'price':
                $query->orderBy('price', 'ASC');
                break;
            case 'price-desc':
                $query->orderBy('price', 'DESC');
                break;
            case 'alphabet':
                $query->orderBy('name', 'ASC');
                break;
            case 'alphabet-desc':
                $query->orderBy('name', 'DESC');
                break;
            default:
                $query->orderBy('created_at', 'ASC');
                break;
        }

        return $query;
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_attribute_options')
            ->withPivot('is_default', 'price', 'attribute_option_id');
    }
    public function getAttributesWithTranslations()
    {
        // Eager load the attributes with their options and translations
        $this->load('attributes');

        // Return the product with loaded attributes
        return $this;
    }

    public function attributeOptions()
    {
        return $this->belongsToMany(AttributeOption::class, 'product_attribute_options')
            ->withPivot('is_default', 'price')
            ->withTimestamps();
    }

    public function getDefaultOptions($attribute_name)
    {
        $defaultOptions = [];

        foreach ($this->attributeOptions as $options) {
            if ($options->attribute->name === $attribute_name && $options->pivot->is_default == 1) {
                $defaultOptions[strtolower($attribute_name)] = optional($options->translations->where('locale', 'en')->first())->value;
            }
        }

        return $defaultOptions;
    }

    public function getDefaultOptionsColor($product_id)
    {
        $defaultOptions = [];

        foreach ($this->attributeOptions as $options) {
            if ($options->attribute->name === 'color' && $options->pivot->is_default == 1) {
                $defaultOptions['color'] = optional($options->translations->where('locale', 'en')->first())->value;
            }
        }

        return $defaultOptions;
    }

    public function getDefaultOptionsSize($product_id)
    {
        $defaultOptions = [];

        foreach ($this->attributeOptions as $options) {
            if ($options->attribute->name === 'size' && $options->pivot->is_default == 1) {
                $defaultOptions['size'] = optional($options->translations->where('locale', 'en')->first())->value;
            }
        }
        return $defaultOptions;
    }


    public function getDefaultSizePrice($product_id)
    {
        $defaultSizePrice = 0;

        foreach ($this->attributeOptions as $options) {
            if ($options->attribute->name === 'size' && $options->pivot->is_default == 1) {
                $defaultSizePrice = $options->pivot->price;
            }
        }

        return $defaultSizePrice;
    }


//     public function search(Request $request)
//     {
//         $query = $request->input('query');

//         // Perform search query on products table
//         $results = Product::where('name', 'like', '%'.$query.'%')->get();

//         // Return search results as JSON response
//         return response()->json($results);
//     }

}
