<?php

namespace App\Http\Controllers\ControlPanel\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPanel\Admin\ShopRequest;
use App\Http\Response\ResponseBuilder;
use App\Models\Shop;
use App\Models\ShopOperator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::getAll();
        return view('control_panel.admin.shop.index', compact(['shops']));
    }

    public function create()
    {
        return view('control_panel.admin.shop.create');
    }

    public function store(ShopRequest $request): JsonResponse
    {
        $request->persist();
        return ResponseBuilder::jsonRedirect(route('cp.admin.shop'));
    }

    public function edit(int $id)
    {
        $shop = Shop::findOrFail($id);
        return view( 'control_panel.admin.shop.edit', compact(['shop']));
    }

    public function update(int $id,ShopRequest $request): JsonResponse
    {
        $request->update($id);
        return ResponseBuilder::jsonRedirect(route('cp.admin.shop'));
    }


}
