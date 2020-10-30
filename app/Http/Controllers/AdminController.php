<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Code;
use App\User;
use App\Models\Order;
use App\Models\Category;
use Image;
use Session;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::all();

        $required_orders = array();
        $i = 0;
        foreach ($orders as $order) {

            if ($order->created_at->format('d m y') == date('d m y')) {
                $required_orders[] = $order;
                $i++;
            }
            if ($i > 4)
                break;
        }

        $data = Code::overall();
        $order_stat = Code::graph();

        $data += ["properties" => 'all', "time" => 'today'];

        return view('backend.admin.dashboard', ['order_stat' => $order_stat])->with($data)->with('required_orders', $required_orders);
    }

    public function fetch_data(Request $request)
    {
        //return $request;
        if ($request->ajax()) {
            if ($request->property == "all") {
                $orders = Order::orderBy('created_at', 'desc')->take(5)->get();

                if ($request->time == "week") {

                    $required_orders = Code::getWeeklyOrders($orders);
                    return view('backend.admin.fetch_data', compact('required_orders'))->render();
                } elseif ($request->time == "month") {

                    $required_orders = Code::getMonthlyOrders($orders);
                    return view('backend.admin.fetch_data', compact('required_orders'))->render();
                } else {

                    $required_orders = array();
                    foreach ($orders as $order) {
                        if ($order->created_at->format('d m y') == date('d m y')) {
                            $required_orders[] = $order;
                        }
                    }
                    return view('backend.admin.fetch_data', compact('required_orders'))->render();
                }
            } elseif ($request->property == "not_del") {
                $orders = Order::where('delivery_status', 0)->orderBy('created_at', 'desc')->take(5)->get();

                if ($request->time == "week") {

                    $required_orders = Code::getWeeklyOrders($orders);
                    return view('backend.admin.fetch_data', compact('required_orders'))->render();
                } elseif ($request->time == "month") {

                    $required_orders = Code::getMonthlyOrders($orders);
                    return view('backend.admin.fetch_data', compact('required_orders'))->render();
                } else {

                    $required_orders = array();
                    foreach ($orders as $order) {
                        if ($order->created_at->format('d m y') == date('d m y'))
                            $required_orders[] = $order;
                    }
                    return view('backend.admin.fetch_data', compact('required_orders'))->render();
                }
            } else {
                $orders = Order::where('payment_status', 0)->orderBy('created_at', 'desc')->take(5)->get();

                if ($request->time == "week") {

                    $required_orders = Code::getWeeklyOrders($orders);
                    return view('backend.admin.fetch_data', compact('required_orders'))->render();
                } elseif ($request->time == "month") {

                    $required_orders = Code::getMonthlyOrders($orders);
                    return view('backend.admin.fetch_data', compact('required_orders'))->render();
                } else {

                    $required_orders = array();
                    foreach ($orders as $order) {
                        if ($order->created_at->format('d m y') == date('d m y'))
                            $required_orders[] = $order;
                    }
                    return view('backend.admin.fetch_data', compact('required_orders'))->render();
                }
            }
        }
    }

    public function orders()
    {
        $orders = Order::all();
        return view('backend.admin.orders', compact('orders'));
    }

    public function propertised_orders($property)
    {
        if ($property == "not-delivered")
            $orders = Order::where('delivery_status', 0)->get();
        else
            $orders = Order::where('payment_status', 0)->get();

        return view('backend.admin.orders', compact('orders'));
    }

    public function order_specific($id)
    {
        $order = Order::where('secret_token_code', $id)->first();
        return view('backend.admin.order_specific')->with('order', $order);
    }

    public function order_status(Request $request)
    {
        $id = $request->id;
        $order = Order::find($id);
        $status = $request->status;
        $value = $request->value;

        if ($status == "payment") {
            if ($value == 1) {
                $order->payment_status = '0';
                $order->save();
                $output = '0';
            } else {
                $order->payment_status = '1';
                $order->save();
                $output = '1';
            }
        } else {
            if ($value == 1) {
                $order->delivery_status = '0';
                $order->save();
                $output = '0';
            } else {
                $order->delivery_status = '1';
                $order->save();
                $output = '1';
            }
        }

        $order->save();
        return $output;
    }
}
