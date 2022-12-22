<?php

use App\Http\Controllers\knowledge\KBController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\knowledge\KBSearchController;
use App\Http\Controllers\Knowledge\SectionController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Storage;

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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('/settings', function () {
    return view('settings.index');
})->middleware(['auth','can:admin'])->name('settings');

Route::resource('ticket', 'App\Http\Controllers\TicketController')->middleware(['auth']);


Route::post('/image/upload', [App\Http\Controllers\UploadController::class, 'image'])->middleware(['auth'])->name('image.upload');

route::get('/test', [App\Http\Controllers\TestController::class, 'index'])->middleware('auth');

/// AXIOS ROUTES ///

Route::post('/fetch', [App\Http\Controllers\AxiosController::class, 'fetchData'])->middleware(['auth'])->name('fetch.data');
Route::post('/update-lock/{id}', [App\Http\Controllers\AxiosController::class, 'updateLock'])->middleware(['auth']);
Route::post('/delete-attachment/{id}/{name}', [App\Http\Controllers\AxiosController::class, 'deleteKBAttachment'])->middleware(['auth']);

Route::get('/file-download/{path}/{name}', [App\Http\Controllers\AxiosController::class, 'fileDownload'])->middleware(['auth'])->name('file-download');

////////////////KNOWLEDGE BASE ROUTES /////////////////////


//Route::get('/article/show/{id}', [App\Http\Controllers\Knowledge\KBController::class, 'show'])->middleware(['auth'])->name('article.show');

Route::resource('kb', KBController::class)->middleware(['auth',]);
Route::get('knowledge/search', [KBSearchController::class, 'index'])->middleware(['auth'])->name('knowledge.search');
Route::get('/knowledge/section', [SectionController::class, 'index'])->middleware(['auth','agent']);
Route::get('/knowledge/section/create', [SectionController::class, 'create'])->middleware(['auth','agent']);

/////////////////settings/////////////////

route::get('settings/fields', [SettingsController::class, 'fields'])->middleware(['auth','can:admin'])->name('incidentFields');
route::get('settings/workflow', [SettingsController::class, 'workflow'])->middleware(['auth','can:admin'])->name('ticketWorkflow');

route::get('settings/workflow/location-based', [SettingsController::class, 'locationBased'])->middleware(['auth','can:admin'])->name('locationBased');
route::get('settings/workflow/category-based', [SettingsController::class, 'categoryBased'])->middleware(['auth','can:admin'])->name('categoryBased');


//////////////// file downloads ////////////

Route::get('download/{file}', function($file){

    $fileName = explode('-',$file);
    return Storage::download('public/uploads/'.$file, $fileName[1]);

})->name('download');

require __DIR__ . '/auth.php';
