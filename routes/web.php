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
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::resource('ticket', 'App\Http\Controllers\TicketController')->middleware(['auth']);


Route::post('/image/upload', [App\Http\Controllers\UploadController::class, 'image'])->middleware(['auth'])->name('image.upload');

route::get('/test', [App\Http\Controllers\TestController::class, 'index']);

/// AXIOS ROUTES ///

Route::post('/fetch', [App\Http\Controllers\AxiosController::class, 'fetchData'])->middleware(['auth'])->name('fetch.data');
Route::post('/update-lock/{id}', [App\Http\Controllers\AxiosController::class, 'updateLock'])->middleware(['auth']);

require __DIR__ . '/auth.php';