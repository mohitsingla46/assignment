<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Validator;

class ProductController extends Controller
{
    public function index(Request $request){
        return view('products');
    }

    public function get_products(Request $request){
        $products = Product::get();
        $returnHTML = view('get_products')->with('products', $products)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public function save_product(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id' => 'nullable',
            'product_name' => 'required|max:255',
            'product_price' => 'required',
            'product_desccription' => 'required',
            'product_images' => 'nullable',
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }
        try{
            $data = $request->all();
            $product_id = $data['product_id'] ?? null;
            $product = Product::where('id', $product_id)->first();
            $saved = Product::createOrUpdate($data, $product);
            if(isset($data['product_images'])){
                foreach($data['product_images'] as $product_image){
                    $p_image['product_id'] = $saved->id;
                    $p_image['image'] = $product_image->store('products');
                    ProductImage::createOrUpdate($p_image);
                }
            }
            return response()->json([
                'status' => true
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => false,
                'errors' => [
                    'general' => $e->getMessage()
                    // 'general' => 'Something went wrong'
                ]
            ]);
        }
    }

    public function delete_product($product_id){
        Product::where('id', $product_id)->delete();
        ProductImage::where('product_id', $product_id)->delete();
    }

    public function edit_product($product_id){
        $product = Product::with('images')->where('id', $product_id)->first();
        $returnHTML = view('edit_product')->with('product', $product)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public function delete_image($image_id){
        ProductImage::where('id', $image_id)->delete();
    }
}
