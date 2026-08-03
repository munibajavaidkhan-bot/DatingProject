<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::where('is_active', true)->orderBy('sort_order')->get();

        return view('user.plans', compact('plans'));
    }

    public function publicIndex()
    {
        $plans = Plan::where('is_active', true)->orderBy('sort_order')->get();

        return view('pricing', compact('plans'));
    }
}
