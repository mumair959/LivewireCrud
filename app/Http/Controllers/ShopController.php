<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    /**
     * Display the shops table.
     */
    public function show(Request $request): View
    {
        return view('shop.show');
    }

    /**
     * Display the shop create form.
     */
    public function create(Request $request): View
    {
        return view('shop.create');
    }

    /**
     * Display the shop edit form.
     */
    public function edit($id): View
    {
        return view('shop.edit', ['id' => $id]);
    }

    /**
     * Display the shop edit form.
     */
    public function detail($id): View
    {
        return view('shop.detail', ['id' => $id]);
    }
}
