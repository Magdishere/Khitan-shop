<?php

namespace App\Http\Livewire\HomePage;

use App\Models\admin\Category;
use Livewire\Component;

class CategoriesComponent extends Component
{
    public function render()
    {
        $categories = Category::get();

        return view('livewire.home-page.categories-component', ['categories' => $categories]);
    }
}
