<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Strings;
use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminStringsController extends Controller
{
    public function index()
    {
        $strings = Strings::get();
        return view('Back.Strings.index', compact('strings'));
    }

    public function create(Request $request)
    {
        return view('Back.Strings.add');

    }

    public function store(Request $request)
    {
        try {

            $imagePath = '';

            if ($request->hasFile('image')) {
                $imagePath = uploadImage('strings', $request->image); // Store the Slides image in the 'public' disk
            }

            $data = [

                'image' => $imagePath,
                'brand' => $request->input('brand'),
                'material' => $request->input('material'),
                'length' => $request->input('length'),
                'color' => $request->input('color'),
                'weight' => $request->input('weight')

            ];


            $strings= Strings::create($data);

            toastr()->addSuccess('Thread added successfully.');
            return redirect()->route('admin-strings.index');
        } catch (\Exception $ex) {
            return redirect()->route('admin-strings.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try {
            // Find the slide by ID
            $string = Strings::findOrFail($id);

            return view('Back.Strings.edit', compact('string'));
        } catch (\Exception $ex) {
            // Show error message using Toastr
            Toastr::error('Slide not found.', 'Error');

            return redirect()->route('admin-strings.index');
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $strings = Strings::findOrFail($id);

            // Check if a new image is being uploaded
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($strings->image) {
                    Storage::disk('strings')->delete($strings->image);
                }

                // Upload the new image
                $strings->image = uploadImage('strings', $request->image);
            }

            // Update other fields
            $strings->brand = $request->input('brand');
            $strings->material = $request->input('material');
            $strings->length = $request->input('length');
            $strings->color = $request->input('color');
            $strings->weight = $request->input('weight');

            // Save the changes
            $strings->save();

            // Show success message using Toastr
            toastr()->addSuccess('Thread updated successfully.');
            return redirect()->route('admin-strings.index');
        } catch (\Exception $ex) {
            // Show error message using Toastr
            Toastr::error('An error occurred. Please try again later.');
            return redirect()->route('admin-strings.index');
        }
    }

    public function destroy(Request $request)
    {
        $strings = Strings::findOrFail($request->id);

        if ($strings->image) {
            Storage::disk('strings')->delete($strings->image);
        }

        $strings->delete();
        toastr()->addSuccess('Thread deleted successfully.');
        return redirect()->route('admin-strings.index');
    }
}
