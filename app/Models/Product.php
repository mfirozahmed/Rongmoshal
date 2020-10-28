<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategory;

class Product extends Model
{
    public $fillable = [
        'name',
        'secret_token_code',
        'price', 
        'image',
        'description',
        'status'
    ];

    public function category($id) {
        $category = ProductCategory::where('product_id', $id)->first();
        return $category;
    }

    public function categoryName($id, $type) {
        $category = Product::category($id);
        if ($type == 'main') 
            $data = Category::find($category->main);
        elseif ($type == 'sub') 
            $data = Category::find($category->sub);
        else
            $data = Category::find($category->sub_sub);

        return $data;
    }
}
