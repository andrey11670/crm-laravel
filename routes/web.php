<?php

use App\Http\Controllers\CancelController;
use App\Http\Controllers\CompleteController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
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
Route::get('/products',ProductController::class);
Route::match(['get' , 'post'],'/orders',OrderController::class)->name('order');

Route::get('/orders/create',CreateController::class)->name('create');
Route::post('/orders',StoreController::class);

Route::get('/orders/{order}',ShowController::class);
Route::patch('/orders/{order}',UpdateController::class);
Route::put('/orders/{order}/complete', CompleteController::class);
Route::put('/orders/{order}/cancel', CancelController::class);
Route::put('/orders/{order}/resume ', ResumeController::class);
//Route::put('/orders/{order}', DestroyController::class)->name('destroy');
Route::match(['get' , 'post'],'/orders/movement/history', MovementController::class);



Route::get('/user', [UserController::class, 'login']);



