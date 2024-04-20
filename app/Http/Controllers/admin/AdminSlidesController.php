<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Slides;
use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminSlidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slides::get();
        return view('Back.Slides.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('Back.Slides.add');

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

            $imagePath = '';

            if ($request->hasFile('image')) {
                $imagePath = uploadImage('slides', $request->image); // Store the Slides image in the 'public' disk
            }

            $data = [
                'image' => $imagePath,
                'en' => [
                    'title' => $request->input('title_en'),
                    'description' => $request->input('description_en'),
                    'link' => $request->input('link_en'),
                ],

                'ar' => [
                    'title' => $request->input('title_ar'),
                    'description' => $request->input('description_ar'),
                    'link' => $request->input('link_ar'),
                ],
            ];


            $slides = Slides::create($data);

            toastr()->addSuccess('Your account has been restored.');
            return redirect()->route('admin-slides.index');
        } catch (\Exception $ex) {
            return redirect()->route('admin-slides.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
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
            $slide = Slides::findOrFail($id);

            // Retrieve translated attributes for English
            $enAttributes = $slide->translate('en');

            // Retrieve translated attributes for Arabic
            $arAttributes = $slide->translate('ar');

            return view('Back.Slides.edit', compact('slide', 'enAttributes', 'arAttributes'));
        } catch (\Exception $ex) {
            // Show error message using Toastr
            Toastr::error('Slide not found.', 'Error');

            return redirect()->route('admin-slides.index');
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
            $slides = Slides::findOrFail($id);

            // Check if a new image is being uploaded
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($slides->image) {
                    Storage::disk('slides')->delete($slides->image);
                }

                // Upload the new image
                $slides->image = uploadImage('slides', $request->image);
            }

            // Update other fields
            $slides->translate('en')->title = $request->input('title_en');
            $slides->translate('en')->description = $request->input('description_en');
            $slides->translate('en')->link = $request->input('link_en');

            $slides->translate('ar')->title = $request->input('title_ar');
            $slides->translate('ar')->description = $request->input('description_ar');
            $slides->translate('ar')->link = $request->input('link_ar');

            // Save the changes
            $slides->save();

            // Show success message using Toastr
            toastr()->addSuccess('Slide updated successfully.');
            return redirect()->route('admin-slides.index');
        } catch (\Exception $ex) {
            // Show error message using Toastr
            Toastr::error('An error occurred. Please try again later.');
            return redirect()->route('admin-slides.index');
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
        $slides = Slides::findOrFail($request->id);

        if ($slides->image) {
            Storage::disk('slides')->delete($slides->image);
        }

        $slides->delete();
        toastr()->addSuccess('Slide deleted successfully.');
        return redirect()->route('admin-slides.index');
    }
}
