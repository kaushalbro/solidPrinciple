<?php


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
Route::get('solid', function () {
//    $userRepo->create(['name'=>'kaushal','email'=>'official.kaushalg@gmail.com','password'=>'kaushal123']);
//    dd($userRepo->getAll());
//    $productRepo->create([
//        'name' => 'Product 1',
//        'description' => 'Your description value',
//        'price' => '2.25',
//        'status' => 'active',
//        'stock_quantity' => '352.252',
//        'category_id' => 1,
//    ]);
    return 'solid';
});
