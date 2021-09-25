<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'category_id', 'product_code', 'root', 'buying_price', 'selling_price', 'supplier_id', 'buying_date', 'image', 'product_quantity',
    ];
}
