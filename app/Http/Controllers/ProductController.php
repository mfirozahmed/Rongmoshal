<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Code;
use App\Models\Category;
use App\Models\ProductCategory;
use Image;
use Session;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::all();
        return view('backend.admin.products')->with('products', $products);
    }

    public function product_specific($id)
    {
        $product = Product::find($id);
        return view('backend.admin.product_specific')->with('product', $product);
    }
    
    public function product_status(Request $request)
    {
        $id = $request->id;
        $value = $request->value;

        $product = Product::find($id);

        if ($value == 1) {
            $product->status = '0';
            $product->save();
            $output = '0';
        }
            
        else {
            $product->status = '1';
            $product->save();
            $output = '1';
        }
            
        echo $output;
    }

    public function product_add()
    {
        $main_categories = Category::where('main', 0)->get();
        return view('backend.admin.product_add')->with('main_categories', $main_categories);
    }

    public function products_add_submit(Request $request)
    {
          $this->validate($request, [
            "name" => "required",
            "price" => "required",
            "image" => "required",
            "description" => "required"
        ]); 
        
        if ($request->get('main-category') == 'x') {
            Session::flash('error', 'Please select the valid main category');
            return redirect()->back()->withInput($request->only('name', 'price', 'image', 'description'));
        }

        $product = new Product;

        $code = bin2hex(random_bytes('4'));
        while (true) {
            $product_code = Product::where('secret_token_code', $code)->first();
            if (is_null($product_code)) {
                break;
            }
            $code = bin2hex(random_bytes('4'));
        }
        
        $product->secret_token_code = $code;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->status = 1;
        $product->has_value = 0;
        
        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filenameToStore = time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images', $filenameToStore);

            $product->image = $filenameToStore;
        }

        $product->save();

        $productCategory = new ProductCategory;
        $productCategory->product_id = $product->id;
        $productCategory->main = $request->get('main-category');
        if ($request->get('sub-category') == 'x')
            $productCategory->sub = null;
        else
            $productCategory->sub = $request->get('sub-category');
        if ($request->get('sub-sub-category') == 'x')
            $productCategory->sub_sub = null;
        else
            $productCategory->sub_sub = $request->get('sub-sub-category');

        $productCategory->save();

        return redirect()->route('admin.products');
    }

    public function product_edit($id)
    {
        $product = Product::find($id);
        $main_categories = Category::where('main', 0)->get();
        $sub_categories = Category::where('sub', 0)->where('main', $product->category($id)->main)->get();
        $sub_sub_categories = Category::where('sub_sub', 0)->where('sub', $product->category($id)->sub)->get();

        return view('backend.admin.product_edit')->with('product', $product)->with('sub_categories', $sub_categories)->with('main_categories', $main_categories)
                ->with('sub_sub_categories', $sub_sub_categories);
    }

    public function product_edit_submit(Request $request, $id)
    {
        $product = Product::find($id);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        if ($request->hasFile('image'))
        {
            Storage::delete('public/images/'.$product->image);

            $extension = $request->file('image')->getClientOriginalExtension();
            $filenameToStore = time().'.'.$extension;
            
            $path = $request->file('image')->storeAs('public/images', $filenameToStore);

            $product->image = $filenameToStore;
        }

        $product->save();

        $productCategory = ProductCategory::where('product_id', $id)->first();
        $productCategory->main = $request->get('main-category');
        if ($request->get('sub-category') == 'x')
            $productCategory->sub = null;
        else
            $productCategory->sub = $request->get('sub-category');
        if ($request->get('sub-sub-category') == 'x')
            $productCategory->sub_sub = null;
        else
            $productCategory->sub_sub = $request->get('sub-sub-category');

        $productCategory->save();
        
        return redirect()->route('admin.products');
    }

    public function product_delete_submit(Request $request)
    {
        $id = $request->id;

        $productCategory = ProductCategory::where('product_id', $id)->first();
        $productCategory->delete();

        $product = Product::find($id);
        Storage::delete('/public/images/'.$product->image);
        $product->delete();
    }

    public function top()
    {
        $signature_products = Product::whereIn('has_value', array(2, 3))->get();
        $new_arrivals = Product::whereIn('has_value', array(1, 3))->get();
        $most_sell = [];

        //return [$signature_products, $most_sell];
        $data = [
            'signature_products' => $signature_products,
            'new_arrivals' => $new_arrivals,
            'most_sell' => $most_sell
        ];
        return view('backend.admin.top')->with($data);
    }

    public function top_add($id)
    {
        $products = Product::all();
        return view('backend.admin.top_add')->with('products', $products)->with('id', $id);
    }

    public function top_add_submit($pid, $type)
    {
        //return [$pid, $type];
        $product = Product::find($pid);
        if ($type == 'signature') {
            if ($product->has_value == 0) 
                $product->has_value = 2;
            elseif ($product->has_value == 1) 
                $product->has_value = 3;

        } elseif ($type == 'new') {
            if ($product->has_value == 0) 
                $product->has_value = 1;
            elseif ($product->has_value == 2) 
                $product->has_value = 3;
        }
        
        $product->save();
        return redirect()->route('admin.top');
    }

    public function top_remove($id)
    {
        if ($id == 'signature')
            $products = Product::whereIn('has_value', array(2, 3))->get();
        elseif ($id == 'new')
            $products = Product::whereIn('has_value', array(1, 3))->get();
        return view('backend.admin.top_remove')->with('products', $products)->with('id', $id);
    }

    public function top_remove_submit($pid, $type)
    {
        $product = Product::find($pid);
        if ($type == 'signature') {
            if ($product->has_value == 3) 
                $product->has_value = 1;
            elseif ($product->has_value == 2) 
                $product->has_value = 0;

        } elseif ($type == 'new') {
            if ($product->has_value == 3) 
                $product->has_value = 2;
            elseif ($product->has_value == 1) 
                $product->has_value = 0;
        }
        
        $product->save();
        return redirect()->route('admin.top');
    }
}
//top=0 ordinary
//top=1 new 
//top=2 signature
//top=3 both new & signature