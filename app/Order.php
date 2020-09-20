<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = [
        'user_id',
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
