<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role != 1) {
            abort(403, 'Unauthorized access.');
        }
        $agentCount = User::where('role', 3)->count();
        $inChargeCount = User::where('role', 2)->count();
        $customerActiveCount = Customer::where('status', 1)->where('approved', 1)->count();
        $customerInactiveCount = Customer::where('status', 0)->where('approved', 1)->count();
        $customerRequestCount = Customer::where('approved', 0)->count();
        return view('backend.index', compact('agentCount', 'inChargeCount', 'customerActiveCount', 'customerInactiveCount', 'customerRequestCount'));
    }


    public function indexAgent()
    {
        if (!Auth::check() || !in_array(Auth::user()->role, [2, 3])) {
            abort(403, 'Unauthorized access.');
        }
        return view('backend.agent.index');
    }

}
