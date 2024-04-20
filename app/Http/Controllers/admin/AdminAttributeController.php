<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Attribute;
use App\Models\admin\AttributeOption;
use App\Models\admin\Category;
use Illuminate\Http\Request;

class AdminAttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::with('options')->get();
        return view('Back.Attributes.index', compact('attributes'));
    }
    public function create()
    {
        $categories = Category::get();
        return view('Back.Attributes.add', compact('categories'));
    }
    public function show()
    {
        $attributes = Attribute::with('options')->get();
        return view('Back.Attributes.show', compact('attributes'));
    }

    public function store(Request $request)
    {

        try {
            $attributeData = [
                'en' => [
                    'name' => $request->input('name_en'),
                ],
                'ar' => [
                    'name' => $request->input('name_ar'),
                ],
            ];

            // Store the attribute data
            $attribute = Attribute::create($attributeData);

            // Store the options data
            foreach ($request->option_name_en as $index => $optionNameEn) {
                $optionData = [
                    'en' => [
                        'value' => $optionNameEn,
                    ],
                    'ar' => [
                        'value' => $request->option_name_ar[$index],
                    ],
                ];

                // Check if the request has option_image for the current option
                if ($request->has('option_image') && isset($request->option_image[$index])) {
                    $filePath = uploadImage('options', $request->option_image[$index]);

                    // Add the image path to the option data
                    $optionData['image'] = $filePath;
                }

                // Create a new AttributeOption instance
                $option = new AttributeOption($optionData);

                // Save the option for the current attribute
                $attribute->options()->save($option);
            }

            // Redirect after processing all options
            return redirect()->route('admin-attributes');
        } catch (\Exception $exception) {
            return $exception;
        }
    }
}
