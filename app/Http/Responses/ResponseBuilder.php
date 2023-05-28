<?php

namespace App\Http\Responses;

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

    public static function jsonError(string $message, array $data = [], int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data
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

    public static function removeElement(string $elementId, string $parentId = '', bool $updateChild = false): JsonResponse
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

    public static function createEditorLibrary(string $path, string $imageArray, string $parentId = '', array $icons = []): JsonResponse
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

    public static function changeImage(string $elementId, string $path, string $imageId = ''): JsonResponse
    {
        return response()->json([
            'functions' => [
                'changeImage' => [
                    'params' => [
                        'elementId' => $elementId,
                        'path' => $path,
                        'imageId' => $imageId,
                    ]
                ]
            ]
        ]);
    }

    public static function jsonFrontSuccessMessage($message): JsonResponse
    {
        return response()->json([
            'functions' => [
                'frontSuccessMessage' => [
                    'params' => [
                        'message' => $message,
                    ]
                ]
            ]
        ]);
    }

    public static function jsonFrontErrorMessage($message): JsonResponse
    {
        return response()->json([
            'functions' => [
                'frontErrorMessage' => [
                    'params' => [
                        'message' => $message,
                    ]
                ]
            ]
        ]);
    }

    public static function jsonSuccessMessage(string $message, array $data = []): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], 200);
    }

    public static function render(string $view, array $data = []): JsonResponse
    {
        return response()->json(
            [
                'view_page' => view($view, $data)->render(),
            ]);
    }
}
