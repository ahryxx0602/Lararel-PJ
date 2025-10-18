<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

//Client router
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth.admin');


Route::prefix('users')->name('users.')->group(function () {

    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/add', [UserController::class, 'add'])->name('add');
    Route::post('/add', [UserController::class, 'postAdd'])->name('post-add');
    Route::get('/edit/{id}', [UserController::class, 'getEdit'])->name('edit');
    Route::post('/update', [UserController::class, 'postEdit'])->name('post-edit');
    Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');
    Route::get('/detail/{id}', [UserController::class, 'getDetailUser'])->name('detail');
});

Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
});
