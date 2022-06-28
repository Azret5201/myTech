<?php

namespace App\Http\Controllers\ControlPanel\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPanel\Client\OrderRequest;
use App\Http\Response\ResponseBuilder;
use App\Models\Block;
use App\Models\CreditProduct;
use App\Models\Document;
use App\Models\FinanceCompany;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth()->user();
        $orders = Order::where('client_id', $user->id)->orderBy('id','desc')->get();
        return view('control_panel.client.order.index', compact('orders'));
    }

    public function create()
    {
        if(!session('cart')) {
            return view('control_panel.client.cart.cart');
        }
        $companies = FinanceCompany::all();
        $documents = Document::all();
        return view('control_panel.client.order.create',compact('documents','companies'));
    }

    public function store(OrderRequest $request) : JsonResponse
    {
        $request->store();
        return ResponseBuilder::jsonRedirect(route('cart'));
    }

    public function getDocuments($id): JsonResponse
    {
        $documents = CreditProduct::find($id)->documents;

        return response()->json([
            'documents' => $documents
        ]);
    }

    public function getCreditProduct($id): JsonResponse
    {
        $product = CreditProduct::find($id);

        return response()->json([
            'product' => $product
        ]);
    }
}
