<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    protected function sendResponse($data): JsonResponse
    {
        return response()->json($data, $data['code'] ?? 200);
    }
}
