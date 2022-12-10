<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'image'];

    public static function createOrUpdate($data, $product = null)
    {
        if (is_null($product)) {
            $product = new ProductImage;
        }
        if (isset($data['product_id'])) {
            $product->product_id = $data['product_id'];
        }
        if (isset($data['image'])) {
            $product->image = $data['image'];
        }
        $product->save();
        return $product;
    }

    public function getImageAttribute($value){
        return url('storage/', $value);
    }
}
