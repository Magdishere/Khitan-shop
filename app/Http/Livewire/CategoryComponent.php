<?php

namespace App\Http\Livewire;

use App\Models\admin\AttributeOption;
use App\Models\admin\Product;
use App\Models\admin\Category;
use App\Services\ProductRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryComponent extends BaseComponent
{
    use WithPagination;

    public $categoryId;
    public $orderBy;
    public $min_price;
    public $max_price;
    public $categoryInputs = [];
    public $selectedColors = [];

    public function mount($id)
    {
        $this->categoryId = $id;

        // Initialize selectedColors for each product
        $products = Product::where('category_id', $id)->get();
        foreach ($products as $product) {
            $this->selectedColors[$product->id] = null;
        }
    }

    public function render()
    {
        $productsQuery = Product::query()->where('category_id', $this->categoryId);

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
        $products = $productsQuery->paginate($this->pageSize);
        $categories = Category::where('parent_id', null)->orderByTranslation('name', 'ASC')->get();
        $attributeOptions = AttributeOption::with('attribute')->get();

        return view('livewire.category-component', [
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
