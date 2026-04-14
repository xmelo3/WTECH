<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        $qty = max(1, (int) $request->quantity);

        $cart = Cart::where('user_id', auth()->id())
                    ->where('product_id', $product->id)
                    ->first();

        if ($cart) {
            $cart->increment('quantity', $qty);
        } else {
            Cart::create([
                'user_id'    => auth()->id(),
                'product_id' => $product->id,
                'quantity'   => $qty,
            ]);
        }

        return back()->with('success', 'Added to cart!');
    }
    public function index()
    {
        $items = Cart::where('user_id', auth()->id())
                     ->with('product')
                     ->get();

        return view('cart', compact('items'));
    }

    public function update(Request $request, Cart $cart)
    {
        if ($request->quantity < 1) {
            $cart->delete();
        } else {
            $cart->update(['quantity' => $request->quantity]);
        }

        return back();
    }

    public function remove(Cart $cart)
    {
        $cart->delete();
        return back();
    }
}