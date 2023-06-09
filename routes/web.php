<?php

use App\Http\Controllers\FacilityController;
use App\Http\Controllers\MinimarketController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [MinimarketController::class, 'index'])->name('home');

Route::get('/minimarkets/create', [MinimarketController::class, 'create'])->name('create');
Route::post('/minimarkets/store', [MinimarketController::class, 'store'])->name('store');
Route::get('/minimarkets/{id}/edit', [MinimarketController::class, 'edit'])->name('edit');
Route::put('/minimarkets/{id}/update', [MinimarketController::class, 'update'])->name('update');
Route::delete('/minimarkets/{id}/delete', [MinimarketController::class, 'delete'])->name('delete');
Route::get('/minimarkets/{id}/remove-picture', [MinimarketController::class, 'removePicture'])->name('remove-picture');
Route::get('/minimarkets/{id}', [MinimarketController::class, 'detail'])->name('detail');
Route::get('/minimarkets', [MinimarketController::class, 'list'])->name('list');

Route::get('/minimarkets/{id}/facilities', [FacilityController::class, 'index'])->name('facility');
Route::post('/minimarkets/{id}/facilities/store', [FacilityController::class, 'store'])->name('store-facility');
Route::put('/minimarkets/{id}/facilities/update', [FacilityController::class, 'update'])->name('update-facility');
Route::delete('/minimarkets/{id}/facilities/delete/{facilityId}', [FacilityController::class, 'delete'])->name('delete-facility');

Route::get('/minimarkets/{id}/suppliers', [SupplierController::class, 'index'])->name('supplier');
Route::post('/minimarkets/{id}/suppliers/store', [SupplierController::class, 'store'])->name('store-supplier');
Route::put('/minimarkets/{id}/suppliers/update', [SupplierController::class, 'update'])->name('update-supplier');
Route::delete('/minimarkets/{id}/suppliers/delete/{supplierId}', [SupplierController::class, 'delete'])->name('delete-supplier');

Route::get('/minimarkets/{id}/product/create', [ProductController::class, 'create'])->name('product-create');
Route::get('/minimarkets/{id}/product', [ProductController::class, 'index'])->name('product');
Route::post('/minimarkets/{id}/product/store', [ProductController::class, 'store'])->name('product-store');
Route::get('/minimarkets/{minimarketId}/product/edit/{productId}', [ProductController::class, 'edit'])->name('product-edit');
Route::put('/minimarkets/{minimarketId}/product/update/{productId}', [ProductController::class, 'update'])->name('product-update');
Route::delete('/minimarkets/{minimarketId}/product/delete/{productId}', [ProductController::class, 'delete'])->name('product-delete');

Route::post('/minimarkets/{id?}/productcategory/store', [ProductCategoryController::class, 'store'])->name('product-category-store');


