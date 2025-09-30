<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

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

Route::get('/unicode', function () {
    return view('form');
});
Route::post('/unicode', function () {
    return ' Phương thức Post của path / unicode';
});

Route::any('unicode', function (Request $request) {
    return $request->method();
});
Route::get('show-form', function () {
    return view('form');
});
