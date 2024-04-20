<?php

namespace App\Http\Livewire;

use App\Models\admin\Reviews;
use Livewire\Component;

class ReviewsComponent extends Component
{
    public $productId;
    public $rating;

    // public function mount($productId)
    // {
    //     $this->productId = $productId;
    // }

    public function render()
    {
        $reviews = Reviews::where('product_id', $this->productId)->get();
        $totalReviews = $reviews->count();
        $averageRating = $totalReviews > 0 ? $reviews->avg('rating') : 0;

        return view('livewire.reviews-component', [
            'totalReviews' => $totalReviews,
            'averageRating' => $averageRating,
        ]);
    }

    public function rateProduct($rating)
    {
        if (auth()->check()) {
            // Create or update the review for the current user and product
            $review = Reviews::updateOrCreate(
                ['product_id' => $this->productId, 'user_id' => auth()->id()],
                ['rating' => $rating]
            );


        } else {
            // Handle the case where the user is not authenticated
            // You can redirect to login or display a message
            // For example, redirect to login:
            return redirect()->route('login');
        }
    }
}
