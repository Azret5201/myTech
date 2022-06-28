<?php

namespace App\Http\Controllers\ControlPanel\Seller;

use App\Http\Controllers\Controller;
use App\Models\DefaultProperty;
use App\Models\Product;
use App\Models\UserProductProperties;
use App\Models\UserProducts;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function getList()
    {
        $userProducts = UserProducts::where('user_id', Auth::user()->id)->paginate(10);
        return view('control_panel.seller.list', compact('userProducts'));
    }

    public function autocomplete(Request $request)
    {
       $datas = Product::getProduct($request->terms);
        return response()->json($datas);
    }

    public function createPropertiesProduct($id)
    {
        $product = Product::find($id);

        $type = true;
        return view('control_panel.seller.product_info', compact('product', 'type'));
    }
    public function editPropertiesProduct($id)
    {
        $userProduct = UserProducts::find($id);
        return view('control_panel.seller.product_info', ['userProduct' => $userProduct, 'type' => false, 'product'=> $userProduct->product]);
    }

    public function storeProperties(Request $request): RedirectResponse
    {
        $user_product = (new Product())->storeUserProduct($request->product_id, $request->quantity);
        $propIds = $request->propId;

        (new Product())->storeUserProductProp($request->propId, $request->props, $user_product->id);

        return redirect()->route('listProducts');
    }

    public function updatePropertiesProduct(Request $request, $id): RedirectResponse
    {
        (new Product)->updateUserProductProps($request->propIds, $request->props, $id);
        (new Product)->updateQuantityProd($request->quantity, $id);

        return redirect()->route('listProducts');

    }
}
