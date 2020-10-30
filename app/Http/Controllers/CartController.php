<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Auth;
use App\User;
use App\Models\Cart;
use App\Models\Order;
use App\Code;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function cart_login(Request $request, $data)
    {
        if ($data == 'cart')
            return redirect()->route('cart', Code::getUserCode(Auth::user()->id));
        elseif ($data == 'shop')
            return redirect()->route('shop');
        else
            return redirect()->route('home');
            //return redirect()->route('specific_product', $data);

    }

    public function show()
    {
        $data = Code::categoryList();

        if (Auth::check()) {
            $token_user = User::find(Auth::user()->id);
            $carts = Cart::where('user_id', $token_user->id)
                     ->where('order_id', null)
                     ->get();
        } else
            $carts = Cart::where('ip_address', request()->ip())->where('order_id', NULL)->get();

        return view('frontend.user.cart.show')->with('carts', $carts)->with($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required'
        ]);

        

        if (Auth::check()) {
            $token_user = User::find(Auth::user()->id);
            $cart = Cart::where('user_id', $token_user->id)
                        ->where('product_id', $request->product_id)
                        ->where('order_id', null)
                        ->first();

            if (is_null($cart)) {
                $cart = new Cart();
                $cart->user_id = $token_user->id;
                $cart->product_id = $request->product_id;
                
                $cart->save();
            } else {
                $cart->increment('quantity');
            }
        } else {
            
            $cart = Cart::where('ip_address', request()->ip())
                        ->where('product_id', $request->product_id)
                        ->where('order_id', null)
                        ->first();

            if (is_null($cart)) {
                $cart = new Cart();
                $cart->ip_address = request()->ip();
                $cart->product_id = $request->product_id;
                
                $cart->save();
            }
            else {
                $cart->increment('quantity');
            }
        }
        
        return json_encode(['status' => 'ok', 'totalItems' => Cart::totalItems()]);
    }

    public function addCart(Request $request)
    {
        if (Auth::check()) {
            $token_user = User::find(Auth::user()->id);
            $cart = Cart::where('user_id', $token_user->id)
                        ->where('product_id', $request->product_id)
                        ->where('order_id', null)
                        ->first();

            if (is_null($cart)) {
                $cart = new Cart();
                $cart->user_id = $token_user->id;
                $cart->product_id = $request->product_id;
                $cart->quantity = $request->quantity;
                
            } else {
                $cart->quantity += $request->quantity;
            }
            $cart->save();
        } else {
            
            $cart = Cart::where('ip_address', request()->ip())
                        ->where('product_id', $request->product_id)
                        ->where('order_id', null)
                        ->first();

            if (is_null($cart)) {
                $cart = new Cart();
                $cart->ip_address = request()->ip();
                $cart->product_id = $request->product_id;
                $cart->quantity = $request->quantity;
                
            }
            else {
                $cart->quantity += $request->quantity;
            }
            $cart->save();
        }

        return back();
    }

    public function update(Request $request)
    {
        if (Auth::check()) {
            $token_user = User::find(Auth::user()->id);
            $carts = Cart::where('user_id', $token_user->id)
                         ->where('order_id', null)
                         ->get();
        } else
            $carts = Cart::where('ip_address', request()->ip())
                         ->where('order_id', null)
                         ->get();

        $quantity = $request->quantity;
        if (count($carts)) {
            $i = 0;
            foreach ($carts as $cart) {
                $cart->quantity = $quantity[$i++];
                $cart->save();
            }
        }
        
        return back();
    }

    public function delete($pid)
    {
        if (Auth::check()) {
            $token_user = User::find(Auth::user()->id);
            $cart = Cart::where('user_id', $token_user->id)
                         ->where('product_id', $pid)
                         ->where('order_id', null)
                         ->first();
        } else
            $cart = Cart::where('ip_address', request()->ip())
                         ->where('product_id', $pid)
                         ->where('order_id', null)
                         ->first();

        $cart->delete();
        return back();
    }

    public function cart_submit(Request $request)
    {
        $this->validate($request, [
            'delivery' => 'required',
        ],
        [
            'delivery.required' => 'Please select your delivery method.',
        ]);
        
        if ($request->delivery == 'inside') {
            $delivery_code = '15d95018';
        } else
            $delivery_code = 'bfd00379';
        
        return redirect()->route('cart.checkout', $delivery_code);
    }

    public function checkout($delivery)
    {
        $data = Code::categoryList();
        if (Auth::check()) {
            $token_user = User::find(Auth::user()->id);
            $carts = Cart::where('user_id', $token_user->id)
                         ->where('order_id', null)
                         ->get();
        } else
            $carts = Cart::where('ip_address', request()->ip())
                         ->where('order_id', null)
                         ->get();

        return view('frontend.user.cart.checkout')->with('carts', $carts)->with('delivery', $delivery)->with($data);
    }

    public function order_submit(Request $request)
    {
        $order = new Order();
        if (Auth::check()) {
            $token_user = User::find(Auth::user()->id);
            $order->user_id = $token_user->id;
            if ($request->selector == null) {
                $this->validate($request, [
                    'shipping_name' => 'required',
                    'shipping_number' => 'required',
                    'shipping_address' => 'required',
                ],
                [
                    'shipping_name.required' => 'Please enter your name for shipping address.',
                    'shipping_number.required' => 'Please enter your number for shipping address.',
                    'shipping_address.required' => 'Please enter your shipping address.',
                ]);
    
                $order->shipping_name = $request->shipping_name;
                $order->shipping_phone = $request->shipping_number;
                $order->shipping_address = $request->shipping_address;
            }else {
    
                $order->shipping_name = $token_user->name;
                $order->shipping_phone = $token_user->phone;
                $order->shipping_address = $token_user->address;
            }
        } else {
            $order->user_id = request()->ip();
            $this->validate($request, [
                'billing_name' => 'required',
                'billing_number' => 'required',
                'billing_address' => 'required',
            ],
            [
                'billing_name.required' => 'Please enter your name for billing address.',
                'billing_number.required' => 'Please enter your number for billing address.',
                'billing_address.required' => 'Please enter your billing address.',
            ]);
            
            if ($request->selector == null) {
                $this->validate($request, [
                    'shipping_name' => 'required',
                    'shipping_number' => 'required',
                    'shipping_address' => 'required',
                ],
                [
                    'shipping_name.required' => 'Please enter your name for shipping address.',
                    'shipping_number.required' => 'Please enter your number for shipping address.',
                    'shipping_address.required' => 'Please enter your shipping address.',
                ]);
    
                $order->shipping_name = $request->shipping_name;
                $order->shipping_phone = $request->shipping_number;
                $order->shipping_address = $request->shipping_address;
            }else {
    
                $order->shipping_name = $request->billing_name;
                $order->shipping_phone = $request->billing_number;
                $order->shipping_address = $request->billing_address;
            }

        }

        $order->price = $request->total_price;
        $order->quantity = $request->total_item;
        $order->payment_method = $request->payment;
        $order->payment_status = 0;
        $order->delivery_status = 0;
        $order->notes = $request->message;

        $code = bin2hex(random_bytes('6'));
        while (true) {
            $order_code = Order::where('secret_token_code', $code)->first();
            if (is_null($order_code)) {
                break;
            }
            $code = bin2hex(random_bytes('6'));
        }
        $order->secret_token_code = $code;

        //return $request->payment;
        if ($request->payment != "Cash On Delivery") {
            $this->validate($request, [
                'transection' => 'required',
            ],
            [
                'transection.required' => 'Please enter your transection id of the payment.',
            ]);
            $order->transection_id = $request->transection;
        }

        if ($request->delivery == '15d95018')
            $order->delivery_method = 'inside';
        else 
            $order->delivery_method = 'outside';
    
        $order->save();

        if (Auth::check()) {
            $token_user = User::find(Auth::user()->id);
            $carts = Cart::where('user_id', $token_user->id)
                        ->where('order_id', null)
                        ->get();
        } else {
            $carts = Cart::where('user_id', request()->ip())
                        ->where('order_id', null)
                        ->get();
        }

        foreach ($carts as $cart) {
            $cart->order_id = $order->id;
            $cart->save();
        }

        return redirect()->route('order.confirm', $order->secret_token_code);
    }

    public function order_placed($oid)
    {
        $data = Code::categoryList();
        if (Auth::check()) {
            $token_user = User::find(Auth::user()->id);
            $order = Order::where('user_id', $token_user->id)
                          ->where('secret_token_code', $oid)
                          ->first();
        } else
            $order = Order::where('secret_token_code', $oid)->first();

        return view('user.cart.confirmation')->with('order', $order)->with($data);
    }

    
}
