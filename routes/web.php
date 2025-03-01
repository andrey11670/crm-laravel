<?php

use App\Http\Controllers\Orders\CancelController;
use App\Http\Controllers\Orders\CompleteController;
use App\Http\Controllers\Main\OrderController;
use App\Http\Controllers\Movement\MovementController;
use App\Http\Controllers\Orders\CreateController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Orders\ResumeController;
use App\Http\Controllers\Orders\ShowController;
use App\Http\Controllers\Orders\StoreController;
use App\Http\Controllers\Orders\UpdateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Warehouses\WarehouseController;
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
    return \Illuminate\Support\Facades\Redirect::to('orders');
});
Route::get('/warehouses', WarehouseController::class);

Route::get('/products', ProductController::class);

Route::match(['get' , 'post'],'/orders', OrderController::class)->name('order');

Route::get('/orders/create', CreateController::class)->name('create');
Route::post('/orders', StoreController::class);
Route::get('/orders/{order}', ShowController::class);
Route::patch('/orders/{order}', UpdateController::class);
Route::put('/orders/{order}/complete', CompleteController::class);
Route::put('/orders/{order}/cancel', CancelController::class);
Route::put('/orders/{order}/resume', ResumeController::class);

//Route::put('/orders/{order}', DestroyController::class)->name('destroy');
Route::match(['get' , 'post'],'/orders/movement/history', MovementController::class);



//Route::get('/user', [UserController::class, 'login']);



