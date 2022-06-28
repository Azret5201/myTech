<?php

namespace App\Http\Controllers\ControlPanel\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPanel\Admin\ProductRequest;
use App\Http\Response\ResponseBuilder;
use App\Models\Brand;
use App\Models\Category;
use App\Models\DefaultProperty;
use App\Models\FileUpload;
use App\Models\Product;
use App\Models\ProductProperty;
use App\Models\UserProductProperties;
use App\Models\UserProducts;
use App\Services\File\Enum\Disk;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::sortable()->with('brand', 'category')->orderBy('created_at', 'desc')->get();
        $brands = Brand::getAll();
        $categories = Category::withDepth()->defaultOrder()->get();
        return view('control_panel.admin.product.index', compact(['categories', 'brands', 'products']));
    }

    public function create()
    {
        $properties = DefaultProperty::all();
        $brands = Brand::getAll();
        $categories = Category::withDepth()->defaultOrder()->get();

        return view('control_panel.admin.product.create', compact(['categories', 'brands', 'properties']));
    }

    public function store(ProductRequest $request): JsonResponse
    {

        $request->persist();
        return ResponseBuilder::jsonRedirect(route('cp.admin.product'));
    }

    public function edit(int $id, $replicate = null)
    {
        $product = Product::where('id', $id)->with('brand')->with('category')->first();
        $productProperties = ProductProperty::where('product_id', $product->id)->with('propName')->orderBy('should_user_fill', 'desc')->get();
        $images = FileUpload::where('entity_id', $id)->orderBy('params->order', 'asc')->get();
        $properties = DefaultProperty::all();
        $brands = Brand::getAll();
        $categories = Category::withDepth()->defaultOrder()->get();
        if ($replicate !== null){
            $product = $replicate;
        }
        return view( 'control_panel.admin.product.edit', compact(['product', 'productProperties', 'categories', 'brands', 'properties', 'images']));
    }

    public function replicate(int $id)
    {
        $images = FileUpload::where('entity_id', $id)->orderBy('params->order')->get();
        $product = Product::where('id', $id)->with('brand')->with('category')->first();
        $productProperties = ProductProperty::where('product_id', $product->id)->with('propName')->orderBy('should_user_fill', 'desc')->get();
        $newProduct = $product->replicate();
        $properties = DefaultProperty::all();
        $brands = Brand::getAll();
        $categories = Category::withDepth()->defaultOrder()->get();
        $newProduct->id = $product->id + 1;
        $product = $newProduct;

        return view( 'control_panel.admin.product.replicate', compact(['product', 'productProperties', 'categories', 'brands', 'properties', 'images']));
    }

    public function update(int $id,ProductRequest $request): JsonResponse
    {
        $request->update($id);
        return ResponseBuilder::jsonRedirect(route('cp.admin.product'));
    }

    public function storeImage(ProductRequest $request): JsonResponse
    {
        $image = $request->storeImage();
        $path = asset(Disk::PRODUCT_PATH()->getValue());
        return ResponseBuilder::addImage('#pro_images', $path . '/' . $image->original_name,false, $image->id, $image->params->order);
    }

    public function destroyImage(ProductRequest $request): JsonResponse
    {
        $elementId = $request->destroyImage();
        return ResponseBuilder::removeElement($elementId, '.preview-images-zone', true);
    }

    public function sortImage(ProductRequest $request)
    {
        $request->sortImage();
    }
}
