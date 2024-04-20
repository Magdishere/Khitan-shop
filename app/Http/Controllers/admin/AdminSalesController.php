<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Category;
use App\Models\admin\Product;
use App\Models\Sale;
use App\Sale\Strategies\Factories\SaleStrategyFactory;
use App\Sale\Strategies\interfaces\CategorySaleStrategyInterface;
use App\Sale\Strategies\interfaces\ImageSaleStrategyInterface;
use App\Sale\Strategies\interfaces\ProductCategoryCheckStrategyInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminSalesController extends Controller
{
    protected $commandInvoker;


    public function index()
    {
        $products = Product::get();
        $sales = Sale::with('products')
            ->activeSales()
            ->get();
        return view('Back.Sales.index', compact('products', 'sales'));
    }

    private function handleImageUpload(Request $request)
    {
        if ($request->has('banner')) {
            return uploadImage('sales', $request->banner);
        }

        return null;
    }

    public function create()
    {
        // 1. Get category ids of category sales
        $categorySaleIds = Sale::where('target_type', 'category')
            ->activeSales()
            ->with('categories:id')
            ->get()
            ->pluck('categories.*.id')
            ->flatten()
            ->toArray();

        // 2. Get products where category_id is in the obtained ids
        $categoryProducts = Product::whereIn('category_id', $categorySaleIds)->get();

        // 3. Get products that are not associated with any sale and not in the categoryProducts
        $productsWithoutSale = Product::whereDoesntHave('sales', function ($query) {
            $query->where('is_active', 1);
        })
            ->whereNotIn('id', $categoryProducts->pluck('id'))
            ->get();



        // Remove duplicate products based on their IDs
        $uniqueProducts = $productsWithoutSale->unique('id')->values();

        // Get all categories
        $categories = Category::get();

        return view('Back.Sales.add', compact('uniqueProducts', 'categories'));
    }


    public function store(
        Request $request,
        CategorySaleStrategyInterface $categorySaleStrategy,
        ProductCategoryCheckStrategyInterface $productCategoryCheckStrategy
    ) {
        try {

            DB::beginTransaction();

            //Upload the image if existed
            $filePath = $this->handleImageUpload($request);

            //If the sale type is category
            //validate that category not in running sale
            $categorySaleStrategy->checkExistingCategorySale($request);

            //If the sale type is product
            //validate that product's category not in running sale
            $productCategoryCheckStrategy->checkProductsInSameCategory($request);

            $strategy = SaleStrategyFactory::create($request);
            $strategy->storeSale($request, $filePath);

            DB::commit();

            return redirect()->route('admin-sales.index')->with('success', 'Sales has been applied');
        } catch (\Exception $exception) {
            return $exception;
            DB::rollBack();
            return redirect()->route('admin-sales.index')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }
    }



    public function edit($saleId)
    {
        // 1. Find the sale by its ID
        $sale = Sale::findOrFail($saleId);

        // Initialize an empty array to hold the associated IDs
        $associatedIds = [];

        // 2. Check the target_type of the sale
        if ($sale->target_type === 'category') {
        // If target_type is category, get category IDs associated with this sale
        $associatedIds = $sale->categories()->select('categories.id')->pluck('id')->toArray();
        } elseif ($sale->target_type === 'product') {
            // If target_type is product, get product IDs associated with this sale
            $associatedIds = $sale->products()->select('products.id')->pluck('id')->toArray();
        }


        // Get all categories and products
        $categories = Category::get();
        $products = Product::get();
        return view('Back.Sales.edit', compact('associatedIds', 'products', 'categories', 'saleId', 'sale'));
    }

    public function update(
        Request $request,
        CategorySaleStrategyInterface $categorySaleStrategy,
        ProductCategoryCheckStrategyInterface $productCategoryCheckStrategy,
        $saleId // Assuming this parameter is used to identify the sale being updated
    ) {
        try {
            DB::beginTransaction();

            // Fetch the sale to be updated
            $sale = Sale::findOrFail($saleId);

            // Upload the image if it exists
            $filePath = $this->handleImageUpload($request);

            // If the sale type is category, validate that the category is not in a running sale
            $categorySaleStrategy->checkExistingCategorySale($request);

            // If the sale type is product, validate that the product's category is not in a running sale
            $productCategoryCheckStrategy->checkProductsInSameCategory($request);

            // Update the sale using the appropriate strategy
            $strategy = SaleStrategyFactory::create($request);
            $strategy->updateSale($sale, $request, $filePath);

            DB::commit();

            return redirect()->route('admin-sales.index')->with('success', 'Sale has been updated');
        } catch (\Exception $exception) {
            return $exception;
            DB::rollBack();
            return redirect()->route('admin-sales.index')->with(['error' => 'An error occurred. Please try again later.']);
        }
    }



}
