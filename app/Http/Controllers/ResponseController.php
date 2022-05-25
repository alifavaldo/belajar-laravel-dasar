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
        return response("hello response");
    }

    public function header(Request $request): Response
    {
        $body = [
            "firstname" => "Alif",
            "lastname" => "Avaldo"
        ];

        return response(json_encode($body), 200)
            ->header('Content-Type', 'aplication/json')
            ->withHeaders([
                'Author' => 'Alif Avaldo',
                'App' => 'Belajar Laravel Dasar'
            ]);
    }


    public function responseView(Request $request): Response
    {
        return response()
            ->view('hello', ['name' => 'Alif']);
    }

    public function responseJson(Request $request): JsonResponse
    {
        $body = [
            "firstname" => "Alif",
            "lastname" => "Avaldo"
        ];

        return response()
            ->json($body);
    }

    public function responseFile(Request $request): BinaryFileResponse
    {
        return response()
            ->file(storage_path('app/public/pictures/githubpp.jpeg'));
    }

    public function responseDownload(Request $request): BinaryFileResponse
    {
        return response()
            ->download(storage_path('app/public/pictures/githubpp.jpeg'));
    }
}
