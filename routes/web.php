<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::redirect('/login', 'admin/login')->name('login');
Route::redirect('/acceder', 'app/acceder')->name('acceder');

//Route::get('/', [HomeController::class, 'index'])->name('home.index');