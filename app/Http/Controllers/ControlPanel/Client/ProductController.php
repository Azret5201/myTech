<?php

namespace App\Http\Controllers\ControlPanel\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('control_panel.client.product.show', compact('product'));
    }

    public function shopProductShow($slug, $productSlug)
    {
        $product = Product::where('slug', $productSlug)->first();
        return view('control_panel.client.product.show', compact('product'));
    }
}
