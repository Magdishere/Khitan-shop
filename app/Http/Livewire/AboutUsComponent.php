<?php

namespace App\Http\Livewire;

use App\Models\admin\Strings;
use Livewire\Component;

class AboutUsComponent extends Component
{
    public function render()
    {
        $strings = Strings::get();
        return view('livewire.about-component', ['strings' => $strings]);

    }
}
