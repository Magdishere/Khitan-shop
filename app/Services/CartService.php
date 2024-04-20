<?php

namespace App\Services;

use App\Models\admin\Attribute;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\admin\Product;

class CartService implements CartServiceInterface
{
    public function addToCart($product_id, $product_name, $product_price, $selectedColor, $selectedSize)
    {
        // Ensure selected color and size are not null
        $selectedColor = $selectedColor ?? null;
        $selectedSize = $selectedSize ?? null;

        // If selectedColor or selectedSize is null, set default options
        if ($selectedColor === null || $selectedSize === null) {
            list($selectedColor, $selectedSize) = $this->setDefaultOptions($product_id, $selectedColor, $selectedSize);
        }

        // Check if the product with the same ID and attributes already exists in the cart
        $existingItem = $this->findCartItem($product_id, $selectedColor, $selectedSize);

        // If the item already exists, update its quantity; otherwise, add a new item to the cart
        if ($existingItem->isNotEmpty()) {
            $this->updateCartItemQuantity($existingItem->first()->rowId);
        } else {
            $this->addNewCartItem($product_id, $product_name, $product_price, $selectedColor, $selectedSize);
        }

    }

    private function setDefaultOptions($product_id, $selectedColor, $selectedSize)
    {
        // Retrieve default options for the product
        $defaultOptions = Product::find($product_id);
        $attributes = Attribute::all();
        $selectedOptions = [];

        foreach ($attributes as $attribute) {
            $defaultOptionsAttribute = $defaultOptions->getDefaultOptions($attribute->name);
            $selectedOptions[strtolower($attribute->name)] = $selectedOptions[strtolower($attribute->name)] ?? $defaultOptionsAttribute[$attribute->name] ?? null;
        }

        // Update selected color and size if they are null
        $selectedColor = $selectedColor ?? $selectedOptions['color'];
        $selectedSize = $selectedSize ?? $selectedOptions['size'];

        return [$selectedColor, $selectedSize];
    }

    private function findCartItem($product_id, $selectedColor, $selectedSize)
    {
        // Search for the item in the cart
        return Cart::instance('cart')->search(function ($cartItem, $rowId) use ($product_id, $selectedColor, $selectedSize) {
            return $cartItem->id == $product_id && $cartItem->options->color == $selectedColor && $cartItem->options->size == $selectedSize;
        });
    }

    private function updateCartItemQuantity($rowId)
    {
        // Update quantity of the existing item in the cart
        Cart::instance('cart')->update($rowId, 1);
    }

    private function addNewCartItem($product_id, $product_name, $product_price, $selectedColor, $selectedSize)
    {
        // Add a new item to the cart
        $defaultOptions = Product::find($product_id);
        $defaultOptionsSizePrice = $defaultOptions->getDefaultSizePrice($product_id);
        $totalPrice = $product_price + $defaultOptionsSizePrice;
        Cart::instance('cart')->add($product_id, $product_name, 1, $totalPrice, ['color' => $selectedColor, 'size' => $selectedSize])->associate('\App\Models\admin\Product');
    }
}
