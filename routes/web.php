<?php

use App\Http\Controllers\AffectationController;
use App\Http\Controllers\LocalisationController;
use App\Http\Controllers\ProductController;
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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/product/{refId}',[ProductController::class, 'show'])->name('product.show');
    Route::get('/add-product', [ProductController::class, 'create'])->name('product.manage');
    Route::post('/adding-product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/delete-product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::post('/update-product/{id}', [ProductController::class, 'update'])->name('product.update');

    Route::get('manage-localisation', [LocalisationController::class, 'index'])->name('location');
    Route::get('add-localisation', [LocalisationController::class, 'create'])->name('location.create');
    Route::post('/adding-localisation', [LocalisationController::class, 'store'])->name('location.store');

    Route::get('manage-affectation', [AffectationController::class, 'index'])->name('affectation');
});

Route::get('/register', function(){
    return abort(403);
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
