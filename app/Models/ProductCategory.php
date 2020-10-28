<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductCategory extends Model
{
    public $fillable = [
        'product_id',
        'category_id',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
