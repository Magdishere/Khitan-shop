<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Reviews; // Correcting the namespace
use Livewire\Component;

class AdminDashboardComponent extends Component
{
    public $averageRating; // Define a public property to hold the average rating

    public function mount()
    {
        // Fetch all reviews from the database
        $reviews = Reviews::all();

        // Calculate the total number of reviews and the sum of ratings
        $totalReviews = $reviews->count();
        $totalRatings = $reviews->sum('rating');

        // Calculate the average rating
        $this->averageRating = ($totalReviews > 0) ? $totalRatings / $totalReviews : 0; // Calculate the average rating and assign it to the public property
    }

    public function render()
    {
        return view('livewire.admin.admin-dashboard-component', [
            'averageRating' => $this->averageRating,
        ])->layout('layouts.dashboard');
    }
}
