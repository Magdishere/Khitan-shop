<?php

namespace App\Http\Livewire\HomePage;

use App\Models\admin\Slides;
use Livewire\Component;

class SlidesComponent extends Component
{
    public function render()
    {
        $slides = Slides::get();

        return view('livewire.home-page.slides-component', ['slides' => $slides]);
    }
}
