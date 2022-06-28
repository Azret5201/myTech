<?php

namespace App\Http\Controllers\ControlPanel\Seller;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Category;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function show($slug)
    {
        $shop = Shop::where('slug', $slug)->first();

        $products = self::getShopsProducts($shop);
        $categories = Category::has('products')->get();
        return view('control_panel.client.shop.show', compact( 'products', 'shop', 'categories'));
    }

    public function getShopsProducts($shop)
    {
        $products = collect();
        foreach ($shop->users->pluck('user.products')->collapse()->pluck('product') as $product) {
            if($product->blocks->contains('display', true)){
                $products[] = $product;
            }
        }
        return $products;
    }

    public function getProductsByCategory(Request $request)
    {
        $category = Category::find($request->id);
        $shop = Shop::where('slug', $request->slug)->first();

        $products = self::getShopsProducts($shop);
        $categoryProds = collect();
        foreach ($products as $product) {
            if ($product->category_id == $request->id){

                $categoryProds[] = $product;
            }

        }
        $view = view('control_panel.client.shop.productsList', ['products' => $categoryProds, 'shop' => $shop])->render();
        return response()->json([
            'view' => $view,
        ]);
    }
}
