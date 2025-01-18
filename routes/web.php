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
//})->middleware(['auth'])->name('dashboard');/home/devil/Desktop/laravel_package_test
//

Route::get('/admin/dashboard', function () {
    return view('backend.admin.dashboard');
})->middleware(['auth'])->name('dashboard');

//Route::group(['middleware'=>"auth",'prefix' => 'admin/products', 'as' => 'products.'], function(){
//    $controller= ProductController::class;
//    Route::get('/', [$controller, 'index'])->name('index');
//    Route::get('list', [$controller, 'getList'])->name('list');
//    Route::get('create', [$controller, 'create'])->name('create');
//    Route::get('{id}/edit', [$controller, 'edit'])->name('edit');
//    Route::get('{id}/show', [$controller, 'show'])->name('show');
//    Route::post('/', [$controller, 'store'])->name('store');
//    Route::patch('{id}', [$controller, 'update'])->name('update');
//    Route::delete('{id}/delete', [$controller, 'destroy'])->name('destroy');
//});
Route::group(['middleware'=>"auth",'prefix' => 'admin/users', 'as' => 'users.'], function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('list', [UserController::class, 'getList'])->name('list');
    Route::get('create', [UserController::class, 'create'])->name('create');
    Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
    Route::get('{id}/show', [UserController::class, 'show'])->name('show');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::patch('{id}', [UserController::class, 'update'])->name('update');
    Route::get  ('{id}/delete', [UserController ::class, 'destroy'])->name('destroy');

});
Route::group(['middleware'=>"auth",'prefix' => 'admin/roles', 'as' => 'roles.'], function(){
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::get('list', [RoleController::class, 'getList'])->name('list');
    Route::get('create', [RoleController::class, 'create'])->name('create');
    Route::get('{id}/edit', [RoleController::class, 'edit'])->name('edit');
    Route::get('{id}/show', [RoleController::class, 'show'])->name('show');
    Route::post('/', [RoleController::class, 'store'])->name('store');
    Route::get  ('{id}/delete', [RoleController::class, 'destroy'])->name('destroy');
    Route::put('{id}', [RoleController::class, 'update'])->name('update');
});


require __DIR__.'/auth.php';
