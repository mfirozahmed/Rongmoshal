<?php

namespace App;
use Auth;
use Carbon\Carbon;
use App\Code;
use App\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;

class Code
{
    public static function getUserCode($id) {
        $user = User::find($id);
        return $user->secret_token_code;
    }

    public static function getProductCode($id) {
        $product = Product::find($id);
        return $product->secret_token_code;
    }

    public static function getOrderCode($id) {
        $order = Order::find($id);
        return $order->secret_token_code;
    }






    public static function getWeeklyOrders($orders) {
        
        $required_orders = array();

        $day = intval(date('d'), 10);
        $month = intval(date('m'), 10);
        $year = intval(date('y'), 10);

        $count = 7;
        while (true) {
            foreach ($orders as $order) {
                if ($order->created_at->format('d') == $day and $order->created_at->format('m') == $month and $order->created_at->format('y') == $year)
                    $required_orders[] = $order;
            }
            $day--;
            if ($day == 0) {
                $month--;
                if ($month == 0) {
                    $month = 12;
                    $year--;
                }
                if ($month == 2)
                    $day = 28;
                elseif ($month == 1 or $month == 3 or $month == 5 or $month == 7 or $month == 8 or $month == 10 or $month == 12)
                    $day = 31;
                else
                    $day = 30;
            }
            $count--;

            if ($count == 0)
                break;
        }
        
        return $required_orders;
    }

    public static function getMonthlyOrders($orders) {
        
        $required_orders = array();

        $day = intval(date('d'), 10);
        $month = intval(date('m'), 10);
        $year = intval(date('y'), 10);

        $count = 30;
        while (true) {
            foreach ($orders as $order) {
                if ($order->created_at->format('d') == $day and $order->created_at->format('m') == $month and $order->created_at->format('y') == $year)
                    $required_orders[] = $order;
            }
            $day--;
            if ($day == 0) {
                $month--;
                if ($month == 0) {
                    $month = 12;
                    $year--;
                }
                if ($month == 2)
                    $day = 28;
                elseif ($month == 1 or $month == 3 or $month == 5 or $month == 7 or $month == 8 or $month == 10 or $month == 12)
                    $day = 31;
                else
                    $day = 30;
            }
            $count--;

            if ($count == 0)
                break;
        }
        return $required_orders;
    }

    public static function overAll() {
        $orders = Order::all();
        $user_count = count(User::all());
        $total_items = 0;
        $total_earns = 0;
        $todays_sale = Order::whereDate('created_at', Carbon::today())->count();
        $users_id = array();

        foreach ($orders as $order) {
            $total_items += $order->quantity;
            $total_earns += $order->price;
            $users_id[] = $order->user_id;
        }
        
        [$id_quantity, $name_quantity] = Code::topCustomer($users_id, $orders);

        $data = [
            'user_count' => $user_count,
            'total_items' => $total_items,
            'total_earns' => $total_earns,
            'todays_sale' => $todays_sale,
            'id_quantity' => $id_quantity,
            'name_quantity' => $name_quantity,
        ]; 

        return $data;
    }

    public static function topCustomer($users_id, $orders) {
        sort($users_id);
        $unique_users_id = array_values(array_unique($users_id));
        $unique_users_product_count = array_fill(0, count($unique_users_id), 0);

        $id_quantity = new \Ds\Map(); 
        $name_quantity = new \Ds\Map(); 
        
        for ($i = 0; $i < count($unique_users_id); $i++) {
            $unique_user = User::find($unique_users_id[$i]);
            foreach ($orders as $order) {
                if ($order->user_id == $unique_user->id) {
                    $unique_users_product_count[$i] += $order->quantity; 
                }
            }
            $id_quantity->put($unique_user->id, $unique_users_product_count[$i]);
            $name_quantity->put($unique_user->name, $unique_users_product_count[$i]);
        }

        $id_quantity->sort(function($a, $b) {
            return $b <=> $a;
        });
        $name_quantity->sort(function($a, $b) {
            return $b <=> $a;
        });

        $name_quantity = array_keys($name_quantity->toArray());

        return [$id_quantity, $name_quantity];
    }

    public static function graph() {
        $orders = Order::all();
        $order_stat = array_fill(0, 12, 0);
        foreach ($orders as $order) {
            $month = $order->created_at->format('m');
            $month = intval($month, 10);
            $order_stat[$month-1]++;
        }
        return $order_stat;
    }

    public static function categoryList() {
        $main_categories = Category::where('main', 0)->get();
        $sub_categories = array();
        $sub_sub_categories = array();

        foreach ($main_categories as $main_category) {
            $sub_categories_all = Category::where('main', $main_category->id)->where('sub', 0)->get();
            $sub_categories[$main_category->id] = $sub_categories_all;

            foreach ($sub_categories_all as $sub_category) {
                $sub_sub_categories_all = Category::where('sub', $sub_category->id)->where('sub_sub', 0)->get();
                $sub_sub_categories[$sub_category->id] = $sub_sub_categories_all;
            }

        }

        $data = [
            "main_categories" => $main_categories,
            "sub_categories" => $sub_categories,
            "sub_sub_categories" => $sub_sub_categories
        ];

        return $data;
    }

    public static function topSold($id = null, $type = null) {
        if ($id == null) {
            $products = Product::all();

            $totalSold = array();

            foreach ($products as $product) {
                $productCount = Cart::where('product_id', $product->id)->sum('quantity');
                $totalSold[$product->id] = $productCount;
            }
            
            arsort($totalSold);
            $product_ids = array_keys($totalSold);
            $products = array();
            foreach ($product_ids as $id) {
                $product = Product::find($id);
                $products[] = $product;
            }
            return $products;
        }

        $products = ProductCategory::where($type, $id)->get();
        
        $totalSold = array();

        foreach ($products as $product) {
            $productCount = Cart::where('product_id', $product->product_id)->sum('quantity');
            $totalSold[$product->product_id] = $productCount;
        }
        //return $totalSold;
        arsort($totalSold);
        $product_ids = array_keys($totalSold);
        $products = array();
        foreach ($product_ids as $id) {
            $product = Product::find($id);
            $products[] = $product;
        }
        return $products;
    }
}