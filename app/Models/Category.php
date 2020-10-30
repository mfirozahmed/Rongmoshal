<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Category extends Model
{
    public $fillable = [
        'name',
        'main',
        'sub', 
        'sub_sub',
    ];

    public function main($id) {
        $sub = Category::find($id);
        $main = Category::find($sub->main);
        return $main;
    }

    public function sub($id) {
        $sub_sub = Category::find($id);
        $sub = Category::find($sub_sub->sub);
        return $sub;
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}
