<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductPublicController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'active')->latest()->get();
        return view('pages.products', compact('products'));
    }

    public function show($id)
    {
        $product = Product::where('status', 'active')->findOrFail($id);
        return view('pages.product-show', compact('product'));
    }
}
