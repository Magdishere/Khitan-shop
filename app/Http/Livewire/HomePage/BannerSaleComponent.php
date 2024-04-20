<?php

namespace App\Http\Livewire\HomePage;

use App\Models\Sale;
use Livewire\Component;

class BannerSaleComponent extends Component
{
    public function render()
    {

        $bannerSale = Sale::with('products')
            ->activeSales()
            ->where('is_flash_sale', 0)
            ->where('banner_type', 'image')
            ->where('position', '!=', 0)
            ->orderBy('position')
            ->get();

        return view('livewire.home-page.banner-sale-component', ['bannerSale' => $bannerSale]);
    }
}
