<?php

use App\Http\Controllers\IndexController;
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

Route::get('/',[IndexController::class,"viewIndex"])->name('index');
Route::post('/parse',[IndexController::class,"showParseUrl"])->name('parse');
Route::get('/result',[IndexController::class,"viewResult"])->name('result');
