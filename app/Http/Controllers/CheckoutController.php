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
        $items = $this->cartItems();
        if ($items->isEmpty()) return redirect()->route('cart');
        return view('checkout', compact('items'));
    }

    private function cartItems()
    {
        $q = Cart::query();
        if (auth()->check()) $q->where('user_id', auth()->id());
        else $q->where('session_id', session()->getId())->whereNull('user_id');
        return $q->with('product')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string', 'surname' => 'required|string',
            'email' => 'required|email', 'city' => 'required|string',
            'postal_code' => 'required|string', 'address' => 'required|string',
            'phone' => 'required|string', 'shipping' => 'required|string',
        ]);

        $items = $this->cartItems();
        $shippingPrice = 2.99;
        $subtotal = $items->sum(fn($i) => $i->quantity * $i->product->price);

        $order = Order::create([
            'user_id'        => auth()->id(),                  // null OK now
            'session_id'     => auth()->check() ? null : session()->getId(),
            'name' => $request->name, 'surname' => $request->surname,
            'email' => $request->email, 'city' => $request->city,
            'postal_code' => $request->postal_code, 'address' => $request->address,
            'phone' => $request->phone, 'shipping' => $request->shipping,
            'shipping_price' => $shippingPrice,
            'total' => $subtotal + $shippingPrice,
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }
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

        if (auth()->check()) Cart::where('user_id', auth()->id())->delete();
        else Cart::where('session_id', session()->getId())->delete();

        session()->forget('pending_order_id');
        return redirect()->route('payment.confirmation', $order->id);
    }

    public function confirmation(Order $order)
    {
        $owns = auth()->check()
            ? $order->user_id === auth()->id()
            : $order->session_id === session()->getId();
        abort_unless($owns, 403);
        return view('payment_confirmation', compact('order'));
    }
}