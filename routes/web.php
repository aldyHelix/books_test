<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\DashboardController;

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

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
});

Route::group(['middleware' => ['auth:sanctum', 'verified'], 'prefix' => 'book'], function () {
    Route::get('/', [BookController::class, 'index'])->name('book.index');
    Route::get('/add', [BookController::class, 'add'])->name('book.add');
    Route::post('/create', [BookController::class, 'create'])->name('book.create');
    Route::get('/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
    Route::delete('/delete/{id}', [BookController::class, 'delete'])->name('book.delete');
    Route::get('/detail/{id}', [BookController::class, 'detail'])->name('book.detail');
    Route::put('/update/{id}', [BookController::class, 'update'])->name('book.update');
});

Route::group(['middleware' => ['auth:sanctum', 'verified'], 'prefix' => 'category'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/add', [CategoryController::class, 'add'])->name('category.add');
    Route::post('/create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    Route::put('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
});

Route::group(['middleware' => ['auth:sanctum', 'verified'], 'prefix' => 'genre'], function () {
    Route::get('/', [GenreController::class, 'index'])->name('genre.index');
    Route::get('/add', [GenreController::class, 'add'])->name('genre.add');
    Route::post('/create', [GenreController::class, 'create'])->name('genre.create');
    Route::get('/edit/{id}', [GenreController::class, 'edit'])->name('genre.edit');
    Route::delete('/delete/{id}', [GenreController::class, 'delete'])->name('genre.delete');
    Route::put('/update/{id}', [GenreController::class, 'update'])->name('genre.update');
});


