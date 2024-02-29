<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
    {
        public function index()
        {
            $cartItems = Cart::all();
            // dd($cartItems);
            return view('cart', compact('cartItems'));
        }


        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1'
            ]);

            $existingCartItem = Cart::where('product_id', $validatedData['product_id'])->first();

            if ($existingCartItem) {
                $existingCartItem->increment('quantity', $validatedData['quantity']);
            } else {
                $cart = new Cart();
                $cart->product_id = $validatedData['product_id'];
                $cart->quantity = $validatedData['quantity'];
                $cart->save();
            }

            return redirect()->route('product.cart')->with('success', 'Product stored successfully');
        }

        public function removeFromCart($id)
        {
            $cartItem = Cart::findOrFail($id);
            $cartItem->delete();

            return redirect()->back()->with('success', 'Product removed from cart successfully');
        }


    }
