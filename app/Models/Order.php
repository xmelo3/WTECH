<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'session_id', 'name', 'surname', 'email',
        'city', 'postal_code', 'address', 'phone',
        'shipping', 'shipping_price', 'total', 'status',
        'payment_method', 'paid_at',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}