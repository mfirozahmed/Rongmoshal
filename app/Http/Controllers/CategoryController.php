<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Session;

class CategoryController extends Controller
{
    public function test()
    {
        $select = 'name';
        $value = 'Ear Ring';

        $data = Category::where($select, $value)->first();
        return $data;

    }

    public function categories()
    {
        $main_categories = Category::where('main', 0)->get();
        $sub_categories = Category::where('sub', 0)->get();
        $sub_sub_categories = Category::where('sub_sub', 0)->get();

        $data = [
            'main_categories' => $main_categories,
            'sub_categories' => $sub_categories,
            'sub_sub_categories' => $sub_sub_categories,
        ];
        return view('backend.admin.categories')->with($data);
    }

    public function category_add($type)
    {
        $main_categories = Category::where('main', 0)->get();

        return view('backend.admin.category_add')->with('type', $type)->with('main_categories', $main_categories);
    }

    public function category_fetch(Request $request)
    {
        $value = $request->get('value');
        $select = $request->get('select');
        $dependent = $request->get('dependent');

        if ($select == "main-category")
            $select = 'main';
        else
            $select = 'sub';

        if ($dependent == "sub-category")
            $dependent = 'sub';
        else
            $dependent = 'sub_sub';
        
        $data = Category::where($select, $value)
                        ->where($dependent, 0)
                        ->get();

        $output = '<option value="x">Please select</option>';
        foreach ($data as $row) {
            $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
        }
    
        echo $output;
    }

    public function category_submit(Request $request)
    {
        if ($request->type == "sub-sub") {
            if ($request->get('main-category') == 'x' or $request->get('sub-category') == 'x' or $request->get('sub-category') == null) {
                Session::flash('error', 'Please select the valid main or sub category');
                return redirect()->back()->withInput($request->only('name', 'main_category', 'sub_category'));
            }

            $sub_sub_category = Category::where('sub_sub', 0)
                                        ->where('sub', $request->get('sub-category'))
                                        ->where('main', $request->get('main-category'))
                                        ->where('name', $request->name)
                                        ->first();

            if ($sub_sub_category == null) {
                $sub_sub_category = new Category;
                $sub_sub_category->name = $request->name;
                $sub_sub_category->main = $request->get('main-category');
                $sub_sub_category->sub = $request->get('sub-category');
                $sub_sub_category->sub_sub = 0;

                $sub_sub_category->save();

                Session::flash('success', 'Sub Sub Category added successfully');
                return back();
            }

            Session::flash('error', 'Sub Sub Category already exists');
            return back();

        } elseif ($request->type == "sub") {
            if ($request->get('main-category') == 'x' or $request->get('main-category') == null) {
                Session::flash('error', 'Please select the valid main category');
                return redirect()->back()->withInput($request->only('name', 'main_category'));
            }

            $sub_category = Category::where('sub', 0)->where('main', $request->get('main-category'))->where('name', $request->name)->first();

            if ($sub_category == null) {
                $sub_category = new Category;
                $sub_category->name = $request->name;
                $sub_category->main = $request->get('main-category');
                $sub_category->sub = 0;

                $sub_category->save();

                Session::flash('success', 'Sub Category added successfully');
                return back();
            }

            Session::flash('error', 'Sub Category already exists');
            return back();

        } else {

            $main_category = Category::where('main', 0)->where('name', $request->name)->first();

            if ($main_category == null) {
                $main_category = new Category;
                $main_category->name = $request->name;
                $main_category->main = 0;

                $main_category->save();

                Session::flash('success', 'Category added successfully');
                return back();
            }

            Session::flash('error', 'Category already exists');
            return back();
        }
    }

    public function category_edit($id)
    {
        $category = Category::find($id);
        if ($category->main == 0) {
            $type = 'main';
            $sub_categories = Category::where('main', $id)->where('sub', 0)->get();
            $sub_sub_categories = Array();
            foreach ($sub_categories as $sub_cat)
                $sub_sub_categories[$sub_cat->id] = Category::where('main', $id)->where('sub', $sub_cat->id)->get();

            //return $sub_sub_categories;
        } 
        elseif ($category->sub == 0){
            $type = 'sub';
            //$category = 
            $sub_categories = Category::where('sub', $id)->where('sub_sub', 0)->get();
            $sub_sub_categories = null;
        }
            
        else {
            $type = 'sub_sub';
            $sub_categories = null;
            $sub_sub_categories = null;
        }
            
        return view('backend.admin.category_edit')->with('category', $category)->with('type', $type)->with('sub_categories', $sub_categories)
                ->with('sub_sub_categories', $sub_sub_categories);
    }

    public function category_edit_submit(Request $request, $id)
    {
        return $id;
        $categories = Category::all();
        return view('backend.admin.categories')->with('categories', $categories);
    }

    public function category_delete(Request $request)
    {
        $id = $request->id;
        $category = Category::find($id);
        if ($category->main == 0) {
            $categories = Category::where('main', $id)->get();
            foreach ($categories as $cat)
                $cat->delete();
                
        } elseif ($category->sub == 0) {
            $categories = Category::where('sub', $id)->get();
            foreach ($categories as $cat)
                $cat->delete();
        }

        $category->delete();
        return redirect()->route('admin.categories');
    }

    public function category_update($id, $value)
    {
        $category = Category::find($id);
        $category->name = $value;
        $category->save();
        return 'ok';
    }
}
