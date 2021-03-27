<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Session;
use App\Code;
use App\Models\Product;
use App\Models\Message;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\ProductCategory;

class PageController extends Controller
{
    public function paginate($items, $perPage, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function index()
    {
        /* $new_items = Product::whereIn('has_value', array(1, 3))->get();
        $signature_items = Product::whereIn('has_value', array(2, 3))->get(); */
        
        //return $products;

        $new_items = Product::whereIn('top', array(1, 3))->get();
        $signature_items = Product::whereIn('top', array(2, 3))->get();
        $data = Code::categoryList();

        return view('frontend.pages.welcome')->with('new_items', $new_items)->with('signature_items', $signature_items)->with($data);
    }

    public function shop()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(3);
        $data = Code::categoryList();
        return view('frontend.pages.shop', compact('products'))->with($data);
    }

    function fetch_data(Request $request) {
        
        if ($request->ajax()) {
            //return $request;
            $tab = $request->tab;
            $perPage = $request->perPage;

            if ($tab == 'new')
                $products = Product::orderBy('created_at', 'desc')->paginate($perPage);
            elseif ($tab == 'price')
                $products = Product::orderBy('price', 'desc')->paginate($perPage);
            else {
                $product = Code::topSold();
                $products = $this->paginate($product, $perPage);
            }
                
            
            return view('frontend.pages.pagination_data', compact('products'))->render();
        }
    }

    function category_data(Request $request) {
        
        if ($request->ajax()) {
            //return $request;
            $tab = $request->tab;
            $perPage = $request->perPage;
            $cid = $request->cid;
            $category = Category::find($cid);
            if ($category->main == 0)
                $type = 'main';
            elseif ($category->sub == 0)
                $type = 'sub';
            else
                $type = 'sub_sub';

            if ($tab == 'new') {

                $product_list = ProductCategory::where($type, $cid)->get();
                $product_ids = array();

                foreach ($product_list as $item) 
                    $product_ids[] = $item->product_id;
                
                $products = Product::whereIn('id', $product_ids)->orderBy('created_at', 'desc')->paginate($perPage);

                
                //$products = $this->paginate($product, $perPage);
            } elseif ($tab == 'price') {
                
                $product_list = ProductCategory::where($type, $cid)->get();
                $product_ids = array();

                foreach ($product_list as $item) 
                    $product_ids[] = $item->product_id;
                
                $products = Product::whereIn('id', $product_ids)->orderBy('price', 'desc')->paginate($perPage);
                
                //$products = $this->paginate($product, $perPage);
            } else {

                $product = Code::topSold($cid, $type);
                //return $product;
                $products = $this->paginate($product, $perPage);
            }
                
            
            return view('frontend.pages.pagination_data', compact('products'))->render();
        }
    }

    public function about()
    {
        $data = Code::categoryList();
        return view('frontend.pages.about')->with($data);
    }

    public function contact()
    {
        $data = Code::categoryList();
        return view('frontend.pages.contact')->with($data);
    }

    public function contact_submit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'message' => 'required',
            'email' => 'required | email',
            'subject' => 'required'
        ],
        [
            'name.required' => 'You must have a name, right?',
            'message.required' => 'Without the message, can you submit a message?',
            'email.required' => 'You must have a valid email, right? Or else how will we contact you back?',
            'subject.required' => 'Your message must have a subject, right?',
        ]);

        $message = new Message();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->save();

        $data = Code::categoryList();

        Session::flash('success', 'Message received, we will contact with you as soon as possible.');
        return view('frontend.pages.contact')->with($data);
    }

    public function product($id)
    {
        $data = Code::categoryList();
        $product = Product::find($id);
        return view('frontend.pages.product')->with('product', $product)->with($data);
    }

    public function category($cid) {
        $category = Category::where('name', $cid)->first();
        $product_list = ProductCategory::where('main', $category->id)->get();
        $product_ids = array();

        foreach ($product_list as $item) 
            $product_ids[] = $item->product_id;
        
        $products = Product::whereIn('id', $product_ids)->orderBy('created_at', 'desc')->paginate(3);

        $data = Code::categoryList();
        //$products = $this->paginate($product, 3);
        return view('frontend.pages.categories', compact('products'))->with($data)->with('category', $category);
    }

    public function sub_category($cid, $sid) {
        $category = Category::where('name', $cid)->first();
        $sub_category = Category::where('name', $sid)->where('main', $category->id)->first();
        $product_list = ProductCategory::where('main', $category->id)->where('sub', $sub_category->id)->get();
        $product_ids = array();

        foreach ($product_list as $item) 
            $product_ids[] = $item->product_id;
        
        $products = Product::whereIn('id', $product_ids)->orderBy('created_at', 'desc')->paginate(3);

        //return $products;
        $data = Code::categoryList();
        return view('frontend.pages.sub_categories', compact('products'))->with($data)->with('sub_category', $sub_category);
    }

    public function sub_sub_category($cid, $sid, $ssid) {
        $category = Category::where('name', $cid)->first();
        $sub_category = Category::where('name', $sid)->where('main', $category->id)->first();
        $sub_sub_category = Category::where('name', $ssid)->where('sub', $sub_category->id)->where('main', $category->id)->first();
        $product_list = ProductCategory::where('main', $category->id)->where('sub', $sub_category->id)->where('sub_sub', $sub_sub_category->id)->get();
        $product_ids = array();

        foreach ($product_list as $item) 
            $product_ids[] = $item->product_id;
        
        $products = Product::whereIn('id', $product_ids)->orderBy('created_at', 'desc')->paginate(3);

        //return $products;
        $data = Code::categoryList();
        return view('frontend.pages.sub_sub_categories', compact('products'))->with($data)->with('sub_sub_category', $sub_sub_category);
    }

    public function orders()
    {
        $data = Code::categoryList();
        $orders = Order::where('user_id', request()->ip())->get();

        return view('frontend.pages.order')->with('orders', $orders)->with($data);
    }

}






