<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductCategoryController extends Controller
{
    /**
     * Display the product categories table.
     */
    public function show(Request $request): View
    {
        return view('product_category.show');
    }

    /**
     * Display the product category create form.
     */
    public function create(Request $request): View
    {
        return view('product_category.create');
    }

    /**
     * Display the product category edit form.
     */
    public function edit($id): View
    {
        return view('product_category.edit', ['id' => $id]);
    }
}
