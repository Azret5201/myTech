<?php

namespace App\Http\Controllers\ControlPanel\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPanel\Admin\BlockPositionRequest;
use App\Http\Requests\ControlPanel\Admin\BlockRequest;
use App\Http\Requests\ControlPanel\Admin\FinanceCompanyRequest;
use App\Http\Response\ResponseBuilder;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Block;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    public function index()
    {
        $blocks = Block::orderBy('position','asc')->get();
        return view('control_panel.admin.product_blocks.index',compact('blocks'));
    }

    public function create()
    {
        $blocks = Block::all();
        $products = Product::all();
        return view('control_panel.admin.product_blocks.create' , compact('blocks','products'));
    }

    public function store(BlockRequest $request): JsonResponse
    {
        $request->store();
        return ResponseBuilder::jsonRedirect(route('cp.admin.product_blocks.index'));
    }

    public function edit(int $id)
    {
        if(!$block = Block::find($id)){
            return abort(404);
        }
        $products = Product::all();
        return view( 'control_panel.admin.product_blocks.edit', compact('block','products'));
    }

    public function update(BlockRequest $request, int $id): JsonResponse
    {
        $request->update($id);
        return ResponseBuilder::jsonRedirect(route('cp.admin.product_blocks.index'));
    }

    public function destroy(int $id):JsonResponse
    {
        if(!$block = Block::find($id)){
            return ResponseBuilder::jsonRedirect(route('cp.admin.product_blocks.index'));
        }
        $block->products()->detach();
        $block::destroy($id);
        return ResponseBuilder::jsonRedirect(route('cp.admin.product_blocks.index'));
    }

    public function editPositions()
    {
        $blocks = Block::orderBy('position', 'asc')->get();
        return view( 'control_panel.admin.product_blocks.edit_position', compact('blocks'));
    }

    public function updatePositions(BlockPositionRequest $request): JsonResponse
    {
        $blocks = Block::orderBy('position','asc')->get();
        foreach ($blocks as $index => $block){
            $bl = Block::find($block->id);
            $bl->update([
                'position' => $request->positions[$index],
            ]);
        }
        return ResponseBuilder::jsonRedirect(route('cp.admin.product_blocks.index'));
    }
}
