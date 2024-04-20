<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Reviews;
use Illuminate\Http\Request;

class AdminReviewsController extends Controller
{
    public function index()
    {
        $reviews = Reviews::all();
        return view('Back.reviews.index', compact('reviews'));
    }

    public function destroy($id)
    {
        $reviews = Reviews::findOrFail($id);
        $reviews->delete();
        return redirect()->route('admin-reviews.index')->with('success', 'Review deleted successfully!');
    }
}
