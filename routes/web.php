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

Route::get('/projects', [\App\Http\Controllers\ProjectsController::class, 'index'])->middleware('auth');

Route::get('/projects/{project}', [\App\Http\Controllers\ProjectsController::class, 'show'])->middleware('auth');

Route::post('/projects', [\App\Http\Controllers\ProjectsController::class, 'store'])->middleware('auth');

require __DIR__.'/auth.php';
