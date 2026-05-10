<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /** Build the where-clause that picks the current owner (user OR guest session). */
    private function ownerScope($query)
    {
        if (auth()->check()) {
            return $query->where('user_id', auth()->id());
        }
        return $query->where('session_id', session()->getId())->whereNull('user_id');
    }

    private function ownerAttrs(): array
    {
        return auth()->check()
            ? ['user_id' => auth()->id(), 'session_id' => null]
            : ['user_id' => null, 'session_id' => session()->getId()];
    }

    public function add(Request $request, Product $product)
    {
        $qty = max(1, (int) $request->quantity);

        $cart = $this->ownerScope(Cart::query())
                     ->where('product_id', $product->id)
                     ->first();

        if ($cart) {
            $cart->increment('quantity', $qty);
        } else {
            Cart::create(array_merge($this->ownerAttrs(), [
                'product_id' => $product->id,
                'quantity'   => $qty,
            ]));
        }
        return back()->with('success', 'Added to cart!');
    }

    public function index()
    {
        $items = $this->ownerScope(Cart::query())->with('product')->get();
        return view('cart', compact('items'));
    }

    public function update(Request $request, Cart $cart)
    {
        $this->authorizeOwn($cart);
        if ($request->quantity < 1) $cart->delete();
        else $cart->update(['quantity' => $request->quantity]);
        return back();
    }

    public function remove(Cart $cart)
    {
        $this->authorizeOwn($cart);
        $cart->delete();
        return back();
    }

    private function authorizeOwn(Cart $cart): void
    {
        $ok = auth()->check()
            ? $cart->user_id === auth()->id()
            : $cart->session_id === session()->getId();
        abort_unless($ok, 403);
    }
}