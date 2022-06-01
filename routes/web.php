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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/projects', [\App\Http\Controllers\ProjectsController::class, 'index'])->name('projects');

    Route::get('/projects/create', [\App\Http\Controllers\ProjectsController::class, 'create'])->name('create');

    Route::get('/projects/{project}', [\App\Http\Controllers\ProjectsController::class, 'show']);

    Route::post('/projects', [\App\Http\Controllers\ProjectsController::class, 'store']);
});

require __DIR__.'/auth.php';
