<?php

namespace App\Http\Controllers\ControlPanel\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPanel\Admin\CategoryRequest;
use App\Http\Response\ResponseBuilder;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withDepth()->defaultOrder()->get();
        return view('control_panel.admin.category.index', compact(['categories']));
    }

    public function create()
    {
        $categories = Category::withDepth()->defaultOrder()->get();
        return view('control_panel.admin.category.create', compact(['categories']));
    }

    public function store(CategoryRequest $request): JsonResponse
    {
        $request->persist();
        return ResponseBuilder::jsonRedirect(route('cp.admin.category'));
    }

    public function edit(int $id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::withDepth()->defaultOrder()->get();
        return view( 'control_panel.admin.category.edit', compact(['category', 'categories']));
    }

    public function update(int $id,CategoryRequest $request): JsonResponse
    {
        $request->update($id);
        return ResponseBuilder::jsonRedirect(route('cp.admin.category'));
    }
}
