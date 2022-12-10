<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'product_price','product_desccription'];

    public static function createOrUpdate($data, $product = null)
    {
        if (is_null($product)) {
            $product = new Product;
        }
        if (isset($data['product_name'])) {
            $product->product_name = $data['product_name'];
        }
        if (isset($data['product_price'])) {
            $product->product_price = $data['product_price'];
        }
        if (isset($data['product_desccription'])) {
            $product->product_desccription = $data['product_desccription'];
        }
        $product->save();
        return $product;
    }
}
