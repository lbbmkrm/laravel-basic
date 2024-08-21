<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    public function response(Request $request): Response
    {
        return response('Hello Response');
    }

    public function header(Request $request): Response
    {
        $body = [
            'firstName' => 'anto',
            'lastName' => 'potong'
        ];

        return response(json_encode($body), 200)
            ->header('content type', 'application/json')
            ->withHeaders([
                'author' => 'lbbmkrm',
                'app' => 'Belajar Laravel'
            ]);
    }

    public function responseView(Request $request): Response
    {
        return response()->view('hello', [
            'name' => 'anto'
        ]);
    }

    public function responseJson(Request $request): JsonResponse
    {
        $body = [
            'firstName' => 'anto',
            'lastName' => 'potong'
        ];
        return response()->json($body);
    }
    public function responseFile(Request $request): BinaryFileResponse
    {
        return response()->file(storage_path('app/public/picture/laptop.jpg'));
    }


    public function responseDownload(Request $request): BinaryFileResponse
    {
        return response()->download(storage_path('app/public/picture/laptop.jpg'));
    }
}
