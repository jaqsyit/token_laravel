<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Services\TokenService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    /**
     * @param TokenService $service
     * @return JsonResponse
     */

    protected $service;

    public function __construct(TokenService $service)
    {
        $this->TokenService = $service;
    }

    public function index()
    {
        $response = Token::all();
        return response()->json($response);
    }

    public function refresh(Request $request)
    {
        return $this->TokenService->refreshToken($request);
    }
}
