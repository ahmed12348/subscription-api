<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\JsonResponse;

class PlanController extends Controller
{
    // GET /api/plans
    public function index(): JsonResponse
    {
        $plans = Plan::all();
        return response()->json($plans);
    }
}

