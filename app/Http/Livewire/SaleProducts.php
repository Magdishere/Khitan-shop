<?php

namespace App\Http\Livewire;

use App\Models\admin\AttributeOption;
use App\Models\admin\Category;
use App\Models\admin\Product;
use App\Models\Sale;
use App\Services\ProductRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class SaleProducts extends BaseComponent
{
    use WithPagination;

    public $selectedColors = [];
    public $selectedSize = [];

    public $min_value = 10;
    public $max_value = 1000;
    public $min_price;
    public $max_price;
    public $categoryInputs = [];

    public $pageSize = 12;

    public $orderBy = 'featured';
    protected $listeners = ['sortBy'];

    public function mount($id)
    {
        $this->id = $id;
        $this->sale = Sale::with(['products', 'categories'])->find($this->id);

        // Initialize selectedColors for each product
        $products = Product::all();
        foreach ($products as $product) {
            $this->selectedColors[$product->id] = null;
        }
    }

    public function setPriceRange($min, $max)
    {
        $this->min_price = $min;
        $this->max_price = $max;
    }

    public function addToCart($product_id, $product_name, $product_price)
    {
        // Get the selected color and size from the corresponding arrays
        $selectedColor = $this->selectedColors[$product_id] ?? null;
        $selectedSize = $this->selectedSizes[$product_id] ?? null;

        // If selectedColor or selectedSize is null, get the default options of the product
        if ($selectedColor === null || $selectedSize === null) {
            $defaultOptions = Product::find($product_id);
            $defaultOptionsColor = $defaultOptions->getDefaultOptionsColor($product_id);
            $defaultOptionsSize = $defaultOptions->getDefaultOptionsSize($product_id);
            $defaultOptionsSizePrice = $defaultOptions->getDefaultSizePrice($product_id);
            $selectedColor = $selectedColor ?? $defaultOptionsColor['color'] ?? null;
            $selectedSize = $selectedSize ?? $defaultOptionsSize['size'] ?? null;
        }

        // Check if the product with the same ID and attributes already exists in the cart
        $existingItem = Cart::instance('cart')->search(function ($cartItem, $rowId) use ($product_id, $selectedColor, $selectedSize) {
            return $cartItem->id == $product_id && $cartItem->options->color == $selectedColor && $cartItem->options->size == $selectedSize;
        });

        // Update quantity if the same product with attributes already exists
        $existingItem->isNotEmpty() ? Cart::instance('cart')->update($existingItem->first()->rowId, 1) :
            // Add as a new item if not already in the cart
            $totalPrice = $product_price + $defaultOptionsSizePrice;
        Cart::instance('cart')->add($product_id, $product_name, 1, $totalPrice, ['color' => $selectedColor, 'size' => $selectedSize])->associate('\App\Models\admin\Product');

        session()->flash('success_message', 'Item added to the cart');
        return redirect()->route('shop');
    }

    public function changePageSize($size)
    {
        $this->pageSize = $size;
    }

    public function changeOrder($order)
    {
        $this->orderBy = $order;
    }

    public function addToWishlist($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate("App\Models\admin\Product");
        $this->emitTo('wishlist-icon-component', 'refreshComponent');
    }

    public function removeFromWishlist($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $item) {
            if ($item->id == $product_id) {
                Cart::instance('wishlist')->remove($item->rowId);
                $this->emitTo('wishlist-icon-component', 'refreshComponent');

            }
        }
    }


    public function render()
    {
        $productsQuery = Product::query();

        if ($this->sale->target_type == 'product') {
            $productIds = $this->sale->products->pluck('id')->toArray();

            if (!empty($this->categoryInputs)) {
                $productsQuery->whereIn('category_id', $this->categoryInputs);
            }

            if (!empty($this->orderBy)) {
                ProductRepository::sortBy($productsQuery, $this->orderBy);
            }

            if (!empty($this->min_price) && !empty($this->max_price)) {
                $productsQuery->whereBetween('regular_price', [$this->min_price, $this->max_price]);
            }

            // Paginate the results
            $products = $productsQuery->whereIn('id', $productIds)->paginate();
        } elseif ($this->sale->target_type == 'category') {
            $categoryId = $this->sale->categories->first()->id;

            if (!empty($this->categoryInputs)) {
                $productsQuery->whereIn('category_id', $this->categoryInputs);
            }

            if (!empty($this->orderBy)) {
                ProductRepository::sortBy($productsQuery, $this->orderBy);
            }

            if (!empty($this->min_price) && !empty($this->max_price)) {
                $productsQuery->whereBetween('regular_price', [$this->min_price, $this->max_price]);
            }

            // Paginate the results
            $products = $productsQuery->where('id', $categoryId)->paginate();
        }

        $categories = Category::where('parent_id', null)->orderByTranslation('name', 'ASC')->get();
        $attributeOptions = AttributeOption::with('attribute')->get();

        return view('livewire.sale-products', [
            'products' => $products,
            'categories' => $categories,
            'attributeOptions' => $attributeOptions,
        ]);
    }

    public function sortBy($field)
    {
        $this->orderBy = $field;
    }

}
