<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;

//Client router
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth.admin');
Route::middleware('auth.admin')->prefix('categories')->group(function () {


    //Danh sách chuyên mục
    Route::get('/', [CategoriesController::class, 'index'])->name('categories.list');

    //Lấy chi tiết chuyên mục (Áp dụng cho showForm của chuyên mục)
    Route::get('/edit/{id}', [CategoriesController::class, 'getCategory'])->name('categories.edit');

    //Xử lí update chuyên mục
    Route::post('/edit/{id}', [CategoriesController::class, 'updateCategory']);

    // Hiển thị form add dữ liệu
    Route::get('/add', [CategoriesController::class, 'addCategory'])->name('categories.add');

    //Xử lí add chuyên mục
    Route::post('/add', [CategoriesController::class, 'handleAddCategory']);
    // Xử lí xóa chuyên mục

    Route::delete('/delete/{id}', [CategoriesController::class, 'deleteCategory'])->name('categories.delete');
});

Route::get('san-pham/{id}', [HomeController::class, 'getProductDetail']);
//Admin route
Route::middleware('auth.admin')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('products', ProductsController::class)->middleware('auth.admin.product ');
});
