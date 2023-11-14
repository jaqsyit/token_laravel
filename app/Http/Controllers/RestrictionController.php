<?php

namespace App\Http\Controllers;

use App\Models\Restriction;
use App\Services\RestrictionsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestrictionController extends Controller
{
    /**
     * @param RestrictionsService $service
     * @return JsonResponse
     */

    protected $service;

    public function __construct(RestrictionsService $service)
    {
        $this->RestrictionsService = $service;
    }

    public function index()
    {
        $response = Restriction::all();
        return response()->json($response);
    }

    public function delete(Request $request)
    {
        return $this->RestrictionsService->delete($request);
    }

    public function create(Request $request)
    {
        return $this->RestrictionsService->createOrUpdate($request);
    }

    public function info(Request $request)
    {
        return $this->RestrictionsService->info($request);
    }
}
