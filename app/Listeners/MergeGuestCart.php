<?php
namespace App\Listeners;

use App\Models\Cart;
use Illuminate\Auth\Events\Login;

class MergeGuestCart
{
public function handle(Login $event): void
    {
        $sessionId = session('_old_session_id') ?? session()->getId();
        $userId    = $event->user->id;

        $guestItems = Cart::where('session_id', $sessionId)->whereNull('user_id')->get();

        foreach ($guestItems as $g) {
            $existing = Cart::where('user_id', $userId)
                            ->where('product_id', $g->product_id)
                            ->first();
            if ($existing) {
                $existing->increment('quantity', $g->quantity);
                $g->delete();
            } else {
                $g->update(['user_id' => $userId, 'session_id' => null]);
            }
        }

        session()->forget('_old_session_id');
    }
}