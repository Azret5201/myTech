<?php

namespace App\Http\Controllers\ControlPanel\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPanel\Admin\EditorImageRequest;
use App\Http\Response\ResponseBuilder;
use App\Services\File\Enum\Disk;
use Illuminate\Http\JsonResponse;

class EditorImageController extends Controller
{
    public function getAll(EditorImageRequest $request): JsonResponse
    {
        $imageArray = $request->getAll();
        $icons = $request->getIconsForImages();
        return ResponseBuilder::createEditorLibrary(asset(Disk::EDITOR_LIBRARY_PATH()->getValue()), $imageArray, '#image-library', $icons);
    }

    public function saveImage(EditorImageRequest $request): JsonResponse
    {
        $icons = $request->getIconsForImages();
        $image = $request->saveImage();
        return ResponseBuilder::addImage('#image-library', asset(Disk::EDITOR_LIBRARY_PATH()->getValue() . $image->original_name), $icons);
    }

    public function deleteImage(EditorImageRequest $request): JsonResponse
    {
        $image = $request->deleteImage();
        return ResponseBuilder::removeElement($image, '#image-library');

    }
}
