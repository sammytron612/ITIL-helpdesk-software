<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ImagesController;


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
})->middleware(['auth'])->name('test');

Route::resource('ticket', 'App\Http\Controllers\TicketController')->middleware(['auth']);


Route::post('/image/upload', [ImagesController::class, 'upload'])->middleware(['auth'])->name('image.upload');



route::get('/test', [App\Http\Controllers\TestController::class, 'index']);


require __DIR__ . '/auth.php';