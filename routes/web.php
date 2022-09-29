<?php

use App\Http\Controllers\TodoItemController;
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
Route::get('/delete', [TodoItemController::class,'delete']);
Route::get('/', [TodoItemController::class,'index']);
Route::get('/{page}', [TodoItemController::class,'paginatePage']);
Route::post('/', [TodoItemController::class,'store']);




