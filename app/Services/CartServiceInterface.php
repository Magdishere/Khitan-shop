<?php

namespace App\Services;

interface CartServiceInterface
{
    public function addToCart($productId, $productName, $productPrice, $selectedColor, $selectedSize);
}
