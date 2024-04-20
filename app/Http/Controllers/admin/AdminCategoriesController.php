<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\admin\Category;
use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('Back.Categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('Back.Categories.add', compact('categories'));
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
        if ($request->has('category_image')) {
            $filePath = uploadImage('categories', $request->category_image);
        }


        $data = [
            'slug' => $request->input('slug'),
            'image_path' => $filePath,
            'parent_id' => $request->type == 1 ? null : $request->parent_id,
            'en' => ['name' => $request->input('name_en')],
            'ar' => ['name' => $request->input('name_ar')],
        ];


        $category = Category::create($data);

        toastr()->addSuccess('Category added successfully.');
        return redirect()->route('Admin-Categories.index');
    } catch (\Exception $ex) {
        return redirect()->route('Admin-Categories.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {
            // Find the slide by ID
            $category = Category::findOrFail($id);


            // Retrieve translated attributes for English
            $enAttributes = $category->translate('en');

            // Retrieve translated attributes for Arabic
            $arAttributes = $category->translate('ar');


            $categories = Category::get();

            return view('Back.Categories.edit', compact('category','categories', 'enAttributes', 'arAttributes'));
        } catch (\Exception $ex) {
            // Show error message using Toastr
            Toastr::error('Product not found.', 'Error');

            return redirect()->route('Admin-Categories.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $categories = Category::findOrFail($id);

            // Check if a new image is being uploaded
            if ($request->hasFile('image_path')) {
                // Delete the old image if it exists
                if ($categories->image_path) {
                    Storage::disk('categories')->delete($categories->image_path);
                }

                // Upload the new image
                $categories->image = uploadImage('categories', $request->image_path);
            }

            // Update other fields
            $categories->translate('en')->name = $request->input('name_en');

            $categories->translate('ar')->name = $request->input('name_ar');

            // Save the changes
            $categories->save();

            // Show success message using Toastr
            toastr()->addSuccess('Category updated successfully.');
            return redirect()->route('Admin-Categories.index');
        } catch (\Exception $ex) {
            // Show error message using Toastr
            Toastr::error('An error occurred. Please try again later.');
            return redirect()->route('Admin-Categories.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $categories = Category::findOrFail($request->id);

        if ($categories->image) {
            Storage::disk('categries')->delete($categories->image);
        }

        $categories->delete();
        toastr()->addSuccess('Category deleted successfully.');
        return redirect()->route('admin-slides.index');
    }
}
