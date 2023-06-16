<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;

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
    return view('auth.login');
});

Route::get('/info', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/pdlist', [ProductController::class, 'index'])->name('pdlist.index');
Route::get('/pdlist/create', [ProductController::class, 'create'])->name('pdlist.pd_create');
Route::post('/pdlist', [ProductController::class, 'store'])->name('pdlist.store');
Route::get('/pdlist/{product}', [ProductController::class, 'show'])->name('pdlist.pd_detail');
Route::get('/pdlist/{product}/edit', [ProductController::class, 'edit'])->name('pdlist.pd_edit');
Route::patch('/pdlist/{product}', [ProductController::class, 'update'])->name('pdlist.update');
Route::delete('/pdlist/{product}', [ProductController::class, 'destroy'])->name('pdlist.delete');