<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserProfile;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', [Dashboard::class,'home'])->name('home');
Route::get('/home', [Dashboard::class,'home'])->name('home');
Route::resource('/role', RoleController::class)->only(['index','create','store','edit','update','destroy'])->middleware('auth');
Route::prefix('/payment')->name('payment.')->group(function(){
    Route::get('/new', [PaymentController::class,'new'])->name('new')->middleware('auth');;
    Route::post('/payu', [PaymentController::class,'payu'])->name('payu')->middleware('auth');
    Route::post('/success', [PaymentController::class,'success'])->name('success')->middleware('auth');
    Route::post('/failure', [PaymentController::class,'failure'])->name('failure')->middleware('auth');
});
Route::resource('/profile', UserProfile::class)->only(['index','edit','update'])->middleware('auth');
Auth::Routes();

