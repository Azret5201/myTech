<?php

namespace App\Http\Controllers\ControlPanel\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPanel\Admin\BrandRequest;
use App\Http\Response\ResponseBuilder;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;


class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::getAll();

        return view('control_panel.admin.brand.index', [
            'items' => $brands
        ]);
    }

    public function create()
    {
        return view('control_panel.admin.brand.create');
    }

    public function store(BrandRequest $request): JsonResponse
    {
        $request->persist();
        return ResponseBuilder::jsonRedirect(route('cp.admin.brand'));
    }

    public function massStore(BrandRequest $request): JsonResponse
    {
        $request->massStore();
        return ResponseBuilder::jsonRedirect(route('cp.admin.brand'));
    }

    public function edit(int $id)
    {
        $brand = Brand::getById($id);
        return view( 'control_panel.admin.brand.edit', [
            'brand' => $brand
        ]);
    }

    public function update(BrandRequest $request, int $id): JsonResponse
    {
        $request->update($id);
        return ResponseBuilder::jsonRedirect(route('cp.admin.brand'));
    }
}
