<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;

class Order extends Model
{
    public $fillable = [
        'user_id',
        'user_ip',
        'secret_token_code',
        'quantity',
        'price',
        'payment_method',
        'payment_status',
        'delivery_method',
        'delivery_status',
        'transection_id',
        'notes',
        'shipping_name',
        'shipping_phone',
        'shipping_address',
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function carts() {
        return $this->hasMany(Cart::class);
    }
}
