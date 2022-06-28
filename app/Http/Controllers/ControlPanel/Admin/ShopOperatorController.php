<?php

namespace App\Http\Controllers\ControlPanel\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPanel\Admin\ShopOperatorRequest;
use App\Http\Response\ResponseBuilder;
use App\Models\Shop;
use App\Models\ShopOperator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShopOperatorController extends Controller
{
    public function index(int $id)
    {
        if(!$shop = Shop::findOrFail($id)){
            return abort(404);
        }
        $operators = $shop->operators;
        return view('control_panel.admin.shop_operator.index', compact(['operators','shop']));
    }

    public function create(int $id)
    {
        if(!$shop = Shop::findOrFail($id)){
            return abort(404);
        }
        return view('control_panel.admin.shop_operator.create', compact('shop'));
    }

    public function store(ShopOperatorRequest $request)
    {
        if(!$shop = Shop::findOrFail($request->shop_id)){
            return abort(404);
        }
        $shop = $request->persist($shop);
        return redirect()->route('cp.admin.shop.operator.index',[$shop]);
    }

    public function edit(int $id)
    {
        if(!$operator = ShopOperator::where('id', $id)->first()){
            return abort(404);
        }
        return view('control_panel.admin.shop_operator.edit', compact('operator'));
    }

    public function update(ShopOperatorRequest $request, int $id)
    {
        if(!$operator = ShopOperator::where('id', $id)->first()){
            return abort(404);
        }
        $request->updateUserShop($operator);
        return redirect()->route('cp.admin.shop.operator.index',$operator->entity_id);
    }

}
