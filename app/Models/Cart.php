<?php

namespace App;
use App\Models\Product;
use Auth;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $fillable = [
        'user_id', 
        'product_id',
        'order_id',
        'quantity',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }


    public static function totalItems() {
        
        if (Auth::check()) {
            $token_user = User::find(Auth::user()->id);
            $carts = Cart::where('user_id', $token_user->id)
                         ->where('order_id', null)
                         ->get();
        } else 
            $carts = Cart::where('ip_address', request()->ip())
                         ->where('order_id', null)
                         ->get();

        $total = 0;

        foreach ($carts as $cart)
            $total += $cart->quantity;

        return $total;
    }

}
