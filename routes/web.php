<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HotelController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('admin/login','admin/login');
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::get('admin/dashboard',[AdminController::class, 'dashboard'])->name('admin.dashboard');


Route::get('/hotel', [HotelController::class, 'index'])->name('admin.hotel');
Route::get('/hotels/create', [HotelController::class, 'create'])->name('hotels.create');
Route::post('/hotels/store', [HotelController::class, 'store'])->name('hotels.store');
Route::get('/hotels/{id}', [HotelController::class, 'show'])->name('hotels.show');
Route::get('/admin/hotels/{id}/edit', [HotelController::class, 'edit'])->name('hotels.edit');
Route::post('/admin/hotels/update/{id}', [HotelController::class, 'update'])->name('hotels.update');
Route::get('/admin/hotels/delete/{id}', [HotelController::class, 'destroy'])->name('hotels.destroy');