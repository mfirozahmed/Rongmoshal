<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class ProductCategory extends Model
{
    public $fillable = [
        'product_id',
        'category_id',
    ];
}
