<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
    Route::get('/room/create',[RoomController::class,'create'])->name('room.create');
    Route::post('/room/store',[RoomController::class,'store'])->name('room.store');
    Route::get('/room/index',[RoomController::class,'index'])->name('room.index');
    Route::get('/room/show/{id}',[RoomController::class,'show'])->name('room.show');
    Route::get('/room/edit/{id}',[RoomController::class,'edit'])->name('room.edit');
    Route::put('/room/update/{id}',[RoomController::class,'update'])->name('room.update');
    Route::delete('/room/delete/{room}',[RoomController::class,'destroy'])->name('room.destroy');
});
