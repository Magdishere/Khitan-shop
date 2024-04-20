<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\AttributeOption;
use App\Models\admin\Product;
use App\Models\admin\ProductAttributeOption;
use Illuminate\Http\Request;


class ProductAttributeOptionController extends Controller
{
    public function index()
    {
        $options = ProductAttributeOption::all();
        return view('options.index', compact('options'));
    }

    public function create()
    {
        $products = Product::all();
        $attributeOptions  = AttributeOption::all();
        return view('Back.Options.add', compact('products', 'attributeOptions'));
    }

    public function store(Request $request)
    {
        // Add validation for the request data
        $data = $request->validate([
            'product_id' => 'required',
            'attribute_option_id' => 'required',
            'is_default' => 'boolean',
            'price' => 'numeric',
        ]);

        // Create a new option
        ProductAttributeOption::create($data);

        // Redirect to the index page or show a success message
        return redirect()->route('options.index')->with('success', 'Option created successfully');
    }

    public function edit(ProductAttributeOption $option)
    {
        return view('Back.Options.edit', compact('option'));
    }

    public function update(Request $request, ProductAttributeOption $option)
    {
        // Add validation for the request data
        $data = $request->validate([
            'product_id' => 'required',
            'attribute_option_id' => 'required',
            'is_default' => 'boolean',
            'price' => 'numeric',
        ]);

        // Update the option
        $option->update($data);

        // Redirect to the index page or show a success message
        return redirect()->route('options.index')->with('success', 'Option updated successfully');
    }

    public function destroy(ProductAttributeOption $option)
    {
        // Delete the option
        $option->delete();

        // Redirect to the index page or show a success message
        return redirect()->route('options.index')->with('success', 'Option deleted successfully');
    }
}
