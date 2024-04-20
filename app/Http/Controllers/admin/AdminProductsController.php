<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Attribute;
use App\Models\admin\Category;
use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Support\Facades\Storage;
use App\Models\admin\Product;
use Illuminate\Http\Request;

class AdminProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $products = Product::all();
        return view('Back.Products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $attributes = Attribute::with('options')->get();
        return view('Back.Products.add', compact('categories', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $filePath = "";
            if ($request->has('product_image')) {
                $filePath = uploadImage('products', $request->product_image);
            }


            $data = [
                'slug' => $request->input('slug'),
                'regular_price' => $request->input('regular_price'),
                'SKU' => $request->input('SKU'),
                'stock_status' => $request->input('stock_status'),
                'quantity' => $request->input('quantity'),
                'category_id' => $request->input('category_id'),
                'featured' => $request->input('featured', false),
                'image' => $filePath,


                'en' => [
                    'name' => $request->input('name_en'),
                    'short_description' => $request->input('short_description_en'),
                    'description' => $request->input('description_en'),
                ],
                'ar' => [
                    'name' => $request->input('name_ar'),
                    'short_description' => $request->input('short_description_ar'),
                    'description' => $request->input('description_ar'),
                ],
            ];

//            if (empty($data['en']['name']) || empty($data['ar']['name'])) {
//                throw new \Exception('Both English and Arabic names are required.');
//            }

            $products = Product::create($data);

            if($request->hasFile('product_images')){
                foreach($request->file('product_images') as $image){
                    $filesPath = uploadImage('products', $image);
                    $products->images()->create([
                        'image_path' => $filesPath,
                    ]);
                }
            }

            if ($request->has('attribute_options')) {
                $attributeOptions = $request->input('attribute_options');
                $products->attributeOptions()->attach($attributeOptions);
            }

            toastr()->addSuccess('Product Added successfully.');
            return redirect()->route('admin-products.index');
        } catch (\Exception $ex) {
            return redirect()->route('admin-products.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Product $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::get();

        try {
            // Find the slide by ID
            $products = Product::findOrFail($id);


            // Retrieve translated attributes for English
            $enAttributes = $products->translate('en');

            // Retrieve translated attributes for Arabic
            $arAttributes = $products->translate('ar');

            $attributes = Attribute::with('options')->get();

            return view('Back.Products.edit', compact('products', 'enAttributes', 'arAttributes', 'attributes', 'categories'));
        } catch (\Exception $ex) {
            // Show error message using Toastr
            Toastr::error('Product not found.', 'Error');

            return redirect()->route('admin-products.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $products = Product::findOrFail($id);

            // Check if a new image is being uploaded
            if ($request->hasFile('product_image')) {
                // Delete the old image if it exists
                if ($products->image) {
                    Storage::disk('products')->delete($products->image);
                }
                // Upload the new image
                $products->image = uploadImage('products', $request->product_image);
            }


            // Update other fields
            $products->translate('en')->name = $request->input('name_en');
            $products->translate('en')->short_description = $request->input('short_description_en');
            $products->translate('en')->description = $request->input('description_en');

            $products->translate('ar')->name = $request->input('name_ar');
            $products->translate('ar')->short_description = $request->input('short_description_ar');
            $products->translate('ar')->description = $request->input('description_ar');

            // Save the changes
            $products->save();

            if($request->hasFile('product_images')){
                foreach($request->file('product_images') as $image){
                    $filesPath = uploadImage('products', $image);
                    $products->images()->create([
                        'image_path' => $filesPath,
                    ]);
                }
            }
            if ($request->has('attribute_options')) {
                $attributeOptions = $request->input('attribute_options');

                // Sync the selected attribute options with the product
                $products->attributeOptions()->sync($attributeOptions);
            } else {
                // If no attribute options are selected, you might want to detach all existing options
                $products->attributeOptions()->detach();
            }


            // Show success message using Toastr
            toastr()->addSuccess('Product updated successfully.');
            return redirect()->route('admin-products.index');
        } catch (\Exception $ex) {
            // Show error message using Toastr
            Toastr::error('An error occurred. Please try again later.');
            return redirect()->route('admin-products.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $products = Product::findOrFail($request->id);

        if ($products->image) {
            Storage::disk('products')->delete($products->image);
        }

        if ($products->image_path) {
            Storage::disk('products')->delete($products->image_path);
        }

        $products->delete();
        toastr()->addSuccess('Product deleted successfully.');
        return redirect()->route('admin-products.index');
    }
}
