<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the product categories table.
     */
    public function index(Request $request): View
    {
        return view('dashboard', ['keyword' => $request->keyword]);
    }
}
