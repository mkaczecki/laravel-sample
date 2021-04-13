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
Auth::routes();

Route::get('/jobs/create', [App\Http\Controllers\JobsController::class, 'create']);
Route::post('/jobs', [App\Http\Controllers\JobsController::class, 'store']);
Route::get('/jobs/{job}', [App\Http\Controllers\JobsController::class, 'show']);
Route::get('/jobs', [App\Http\Controllers\JobsController::class, 'index']);
Route::get('/', [App\Http\Controllers\JobsController::class, 'index']);
Route::get('/jobs/apply/{job}', [App\Http\Controllers\JobsController::class, 'apply']);
Route::get('/jobs/candidates/{job}', [App\Http\Controllers\JobsController::class, 'candidates']);
Route::post('/jobs/search', [App\Http\Controllers\JobsController::class, 'search']);

Route::get('/profiles/create',[App\Http\Controllers\ProfilesController::class, 'create']);
Route::post('/profiles', [App\Http\Controllers\ProfilesController::class, 'store']);
Route::get('/profiles/{user}',[App\Http\Controllers\ProfilesController::class, 'show']);

Route::get('/companies/create', [App\Http\Controllers\CompaniesController::class, 'create']);
Route::post('/companies', [App\Http\Controllers\CompaniesController::class, 'store']);
Route::get('/companies/{user}', [App\Http\Controllers\CompaniesController::class, 'show']);

