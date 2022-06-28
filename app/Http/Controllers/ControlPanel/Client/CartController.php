<?php

namespace App\Http\Controllers\ControlPanel\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use function Sodium\increment;

class CartController extends Controller
{
    public function index()
    {
        return view('control_panel.client.cart.cart');

    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->productId);
        $shop = Shop::find($request->shopId);
        $cart = session()->get('cart');

        if (!$cart) {
            $cart = (new Cart())->createCart($shop, $product, $request->all());
            session()->put('cart', $cart);

            self::total();

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        if (isset($cart[$shop->id][$product->id])){
            $cart[$shop->id][$product->id]['quantity'] += $request->quantity;
            $cart[$request->shopId][$request->productId]["subtotal"] += ($cart[$request->shopId][$request->productId]["price"] * $request->quantity);

            session()->put('cart', $cart);
            self::total();

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        $cart[$shop->id][$product->id] = [
            'name' => $product->name,
            'quantity' => $request->quantity,
            'shop' => $shop->name,
            'price' => $request->price,
            'image' => $product->images->first() ? $product->images->first()->getPath() : asset('app/img/no-image.jpg'),
            'subtotal' => $request->price * $request->quantity,
        ];
        session()->put('cart', $cart);
        self::total();

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if($request->shopId and $request->productId)
        {
            if ($request->type == 1)
            {
                $cart = session()->get('cart');
                $cart[$request->shopId][$request->productId]["quantity"] += 1;
                $cart[$request->shopId][$request->productId]["subtotal"] += $cart[$request->shopId][$request->productId]["price"];
                session()->put('cart', $cart);
                $total = self::total();
                session()->flash('success', 'Cart updated successfully');
                return response()->json([
                    'increment' => true,
                    'subtotal' => $cart[$request->shopId][$request->productId]["subtotal"],
                    'total' => $total
                ]);
            }
            else{
                $cart = session()->get('cart');
                $cart[$request->shopId][$request->productId]["quantity"] -= 1;
                $cart[$request->shopId][$request->productId]["subtotal"] -= $cart[$request->shopId][$request->productId]["price"];
                session()->put('cart', $cart);
                session()->flash('success', 'Cart updated successfully');
                $total = self::total();

                return response()->json([
                    'increment' => false,
                    'subtotal' => $cart[$request->shopId][$request->productId]["subtotal"],
                    'total' => $total
                ]);
            }
        }
    }
    public function remove(Request $request)
    {
        if($request->prodId && $request->shopId) {
            $cart = session()->get('cart');
            $total = '';
            if(isset($cart[$request->shopId][$request->prodId])) {
                unset($cart[$request->shopId][$request->prodId]);
                session()->put('cart', $cart);
                $total = self::total();
            }
            if (empty($cart[$request->shopId])){
                unset($cart[$request->shopId]);
                session()->put('cart', $cart);
                $total = self::total();

            }
            session()->flash('success', 'Product removed successfully');
            return response()->json(['total' => $total]);
        }
    }
    public function clear(Request $request)
    {
        $cart = session()->get('cart');
        if ($cart) {
           session()->forget('cart');
        }
        $total = self::total();
        return response()->json(['total' => $total]);
    }

    public function total()
    {
        $cart = session()->get('cart');
        $total = 0;
        if ($cart){
            foreach ($cart as $shop)
            {
                foreach ($shop as $item) {
                    $total += $item['subtotal'];
                }
            }
            session()->put('total', $total);
        }

        return $total;
    }
}
