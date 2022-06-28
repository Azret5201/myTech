<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function createCart($shop, $product, $request)
    {
        $cart = [
            $shop->id => [
                $product->id => [
                    'name' => $product->name,
                    'quantity' => $request['quantity'],
                    'shop' => $shop->name,
                    'price' => $request['price'],
                    'image' => $product->images->first() ? $product->images->first()->getPath() : asset('app/img/no-image.jpg'),
                    'subtotal' => $request['price'] * $request['quantity'],
                ]
            ]
        ];
        return $cart;
    }

    public function addToCart($shop, $product, $request)
    {
        $cart[$shop->id][$product->id] = [
            'name' => $product->name,
            'quantity' => $request['quantity'],
            'shop' => $shop->name,
            'price' => $request['price'],
            'image' => $product->images->first()->getPath(),
            'subtotal' => $request['price'] * $request['quantity'],
        ];

        return $cart;
    }
}
