<?php

namespace App\Http\Controllers\ControlPanel\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPanel\Admin\StaticPageRequest;
use App\Http\Response\ResponseBuilder;
use App\Models\StaticPage;
use Illuminate\Http\JsonResponse;


class StaticPageController extends Controller
{
    public function index()
    {
        $brands = StaticPage::getAll();

        return view('control_panel.admin.static_page.index', [
            'items' => $brands
        ]);
    }

    public function create()
    {
        return view('control_panel.admin.static_page.create');
    }

    public function store(StaticPageRequest $request): JsonResponse
    {
        $request->persist();
        return ResponseBuilder::jsonRedirect(route('cp.admin.page'));
    }


    public function edit(int $id)
    {
        $page = StaticPage::getById($id);
        return view( 'control_panel.admin.static_page.edit', [
            'page' => $page
        ]);
    }

    public function update(StaticPageRequest $request, int $id): JsonResponse
    {
        $request->update($id);
        return ResponseBuilder::jsonRedirect(route('cp.admin.page'));
    }
}
