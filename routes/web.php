<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProductController::class, 'index']);
Route::get('get_products', [ProductController::class, 'get_products']);
Route::post('save_product', [ProductController::class, 'save_product']);
Route::delete('delete_product/{product_id}', [ProductController::class, 'delete_product']);
Route::get('edit_product/{product_id}', [ProductController::class, 'edit_product']);
Route::delete('delete_image/{image_id}', [ProductController::class, 'delete_image']);
