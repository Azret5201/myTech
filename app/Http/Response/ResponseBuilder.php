<?php

namespace App\Http\Response;

use Illuminate\Http\JsonResponse;

class ResponseBuilder
{
    public static function jsonAlertError(string $title, string $message, int $code = 400): JsonResponse
    {
        return response()->json([
            'functions' => [
                'alert' => [
                    'params' => [
                        'title' => $title,
                        'message' => $message,
                        'type' => 'error'
                    ]
                ]
            ]
        ], $code);
    }
    public static function addOption(string $parentId, $value): JsonResponse
    {
        return response()->json([
            'functions' => [
                'addOption' => [
                    'params' => [
                        'parentId' => $parentId,
                        'value' => $value
                    ]
                ]
            ]
        ]);
    }
    public static function addImage(string $parentId, $image, $icons = false, $imageId = false, $num = false): JsonResponse
    {
        return response()->json([
            'functions' => [
                'addImage' => [
                    'params' => [
                        'parentId' => $parentId,
                        'image' => $image,
                        'icons' => $icons,
                        'imageId' => $imageId,
                        'num' => $num,
                    ]
                ]
            ]
        ]);
    }


    public static function jsonRedirect(string $url): JsonResponse
    {
        return response()->json([
            'functions' => [
                'redirect' => [
                    'params' => [
                        'url' => $url
                    ]
                ]
            ]
        ]);
    }

    public static function reload(): JsonResponse
    {
        return response()->json([
            'functions' => [
                'reload'
            ]
        ]);
    }

    public static function removeElement(string $elementId,string $parentId = '',bool $updateChild = false): JsonResponse
    {
        return response()->json([
            'functions' => [
                'removeElement' => [
                    'params' => [
                        'id' => $elementId,
                        'parentId' => $parentId,
                        'updateChildEl' => $updateChild
                    ]
                ]
            ]
        ]);
    }

    public static function createEditorLibrary(string $path,string $imageArray,string $parentId = '', array $icons = []): JsonResponse
    {
        return response()->json([
            'functions' => [
                'createEditorLibrary' => [
                    'params' => [
                        'imageArray' => json_decode($imageArray, true),
                        'parentId' => $parentId,
                        'path' => $path,
                        'icons' => $icons
                    ]
                ]
            ]
        ]);
    }


}
