<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Coupons;
use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Http\Request;

class AdminCouponsController extends Controller
{
    public function index()
    {
        $coupons = Coupons::get();
        return view('Back.Coupons.index', compact('coupons'));
    }

    public function create(Request $request)
    {
        return view('Back.Coupons.add');

    }

    public function store(Request $request)
    {
        try {


            $data = [

                'code' => $request->input('code'),
                'discount' => $request->input('discount'),
                'max_value' => $request->input('max_value'),
                'uses' => $request->input('uses'),
                'max_uses' => $request->input('max_uses'),
                'expires_at' => $request->input('expires_at')
            ];


            $coupons = Coupons::create($data);

            toastr()->addSuccess('Coupon added successfully.');
            return redirect()->route('admin-coupons.index');
        } catch (\Exception $ex) {
            return redirect()->route('admin-coupons.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
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
            $coupon = Coupons::findOrFail($id);

            return view('Back.Coupons.edit', compact('coupon'));
        } catch (\Exception $ex) {
            // Show error message using Toastr
            Toastr::error('Slide not found.', 'Error');

            return redirect()->route('admin-coupons.index');
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $coupons = Coupons::findOrFail($id);

            // Update other fields
            $coupons->code = $request->input('code');
            $coupons->discount = $request->input('discount');
            $coupons->max_value = $request->input('max_value');
            $coupons->uses = $request->input('uses');
            $coupons->max_uses = $request->input('max_uses');
            $coupons->expires_at = $request->input('expires_at');

            // Save the changes
            $coupons->save();

            // Show success message using Toastr
            toastr()->addSuccess('Coupon updated successfully.');
            return redirect()->route('admin-coupons.index');
        } catch (\Exception $ex) {
            // Show error message using Toastr
            Toastr::error('An error occurred. Please try again later.');
            return redirect()->route('admin-coupons.index');
        }
    }

    public function destroy(Request $request)
    {
        $coupons = Coupons::findOrFail($request->id);

        $coupons->delete();

        toastr()->addSuccess('Coupon deleted successfully.');
        return redirect()->route('admin-coupons.index');
    }
}
