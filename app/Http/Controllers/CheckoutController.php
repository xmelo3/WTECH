<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $items = Cart::where('user_id', auth()->id())->with('product')->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart');
        }

        return view('checkout', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string',
            'surname'     => 'required|string',
            'email'       => 'required|email',
            'city'        => 'required|string',
            'postal_code' => 'required|string',
            'address'     => 'required|string',
            'phone'       => 'required|string',
            'shipping'    => 'required|string',
        ]);

        $items        = Cart::where('user_id', auth()->id())->with('product')->get();
        $shippingPrice = 2.99;
        $subtotal     = $items->sum(fn($i) => $i->quantity * $i->product->price);
        $total        = $subtotal + $shippingPrice;

        $order = Order::create([
            'user_id'        => auth()->id(),
            'name'           => $request->name,
            'surname'        => $request->surname,
            'email'          => $request->email,
            'city'           => $request->city,
            'postal_code'    => $request->postal_code,
            'address'        => $request->address,
            'phone'          => $request->phone,
            'shipping'       => $request->shipping,
            'shipping_price' => $shippingPrice,
            'total'          => $total,
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        // ulož order_id do session pre payment
        session(['pending_order_id' => $order->id]);

        return redirect()->route('payment');
    }

    public function payment()
    {
        $order = Order::with('items.product')->findOrFail(session('pending_order_id'));
        return view('payment', compact('order'));
    }

    public function pay(Request $request)
    {
        $order = Order::findOrFail(session('pending_order_id'));

        $order->update([
            'status' => 'paid',
            'payment_method' => $request->payment,
            'paid_at' => now(),
        ]);

        // 🧹 clear cart
        Cart::where('user_id', auth()->id())->delete();

        session()->forget('pending_order_id');

        // 🔥 THIS IS THE KEY CHANGE
        return redirect()->route('payment.confirmation', $order->id);
    }

    public function confirmation(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('payment_confirmation', compact('order'));
    }
}