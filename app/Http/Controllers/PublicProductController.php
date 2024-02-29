<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class PublicProductController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->take(8)->cursor();
        // dd($products);
        // die();
        return view('welcome', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        // dd($product);
        // die();
        return view('shop_ditels', compact('product'));
    }

}
