<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');
//




Route::get('/admin/dashboard', function () {
    return view('backend.admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/admin/product/create', function () {
    return view('backend.admin.product.create');
})->middleware(['auth'])->name('product');

Route::group(['middleware'=>"auth",'prefix' => 'admin/products', 'as' => 'products.'], function(){
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::get('{id}/show', [ProductController::class, 'show'])->name('show');
    Route::post('/', [ProductController::class, 'store'])->name('store');
    Route::patch('{id}', [ProductController::class, 'update'])->name('update');
});
Route::group(['middleware'=>"auth",'prefix' => 'admin/categories', 'as' => 'categories.'], function(){
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('create', [CategoryController::class, 'create'])->name('create');
    Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::get('{id}/show', [CategoryController::class, 'show'])->name('show');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::patch('{id}', [CategoryController::class, 'update'])->name('update');
});
Route::group(['middleware'=>"auth",'prefix' => 'admin/orders', 'as' => 'orders.'], function(){
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('create', [OrderController::class, 'create'])->name('create');
    Route::get('{id}/edit', [OrderController::class, 'edit'])->name('edit');
    Route::get('{id}/show', [OrderController::class, 'show'])->name('show');
    Route::post('/', [OrderController::class, 'store'])->name('store');
    Route::patch('{id}', [OrderController::class, 'update'])->name('update');
});

Route::group(['middleware'=>"auth",'prefix' => 'admin/users', 'as' => 'users.'], function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('list', [UserController::class, 'getList'])->name('list');
    Route::get('create', [UserController::class, 'create'])->name('create');
    Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
    Route::get('{id}/show', [UserController::class, 'show'])->name('show');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::patch('{id}', [UserController::class, 'update'])->name('update');
});
Route::group(['middleware'=>"auth",'prefix' => 'admin/roles', 'as' => 'roles.'], function(){
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::get('list', [RoleController::class, 'getList'])->name('list');
    Route::get('create', [RoleController::class, 'create'])->name('create');
    Route::get('{id}/edit', [RoleController::class, 'edit'])->name('edit');
    Route::get('{id}/show', [RoleController::class, 'show'])->name('show');
    Route::post('/', [RoleController::class, 'store'])->name('store');
    Route::patch('{id}', [RoleController::class, 'update'])->name('update');
});


require __DIR__.'/auth.php';
