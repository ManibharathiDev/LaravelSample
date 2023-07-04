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

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\OrderController;
Route::get('/order', [OrderController::class,'index'])->name('order.list');
Route::get('/order/json/{id}', [OrderController::class,'json'])->name('order.json');
Route::get('/order/create', [OrderController::class,'create'])->name('order.create');



Route::post('/order/store', [OrderController::class,'store'])->name('order.store');;


Route::get('/order/edit/{id}',  [OrderController::class,'edit'])->name('order.edit');;
Route::get('/order/view/{id}',  [OrderController::class,'view'])->name('order.view');;
Route::post('/order/update/{id}', [OrderController::class,'update'])->name('order.update');;

Route::get('/order/delete/{id}', [OrderController::class,'destroy'])->name('order.delete');;

 