<?php

use Illuminate\Support\Facades\Route;
 

Route::get('/main', function () {
    return view('main');
})->name('main');
 Route::get('/sign', function () {
    return view('sign');
})->middleware('guest')->name('login');
Route::get('/browse', function () {
    return view('browse');
})->name('browse'); 
Route::get('/signup', function () {
    return view('signup');
})->middleware('guest')->name('signup');

use App\Http\Controllers\AuthController;

Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\DishController;

Route::get('/search', [DishController::class, 'ingredients'])->name('search');
Route::get('/create', [DishController::class, 'ingredient'])->middleware('auth')->name('create');
Route::get('/search-results', [DishController::class, 'processSearch'])->name('search.results');
route::post('/create', [DishController::class, 'createdish'])->name('create.dish');
Route::get('/browse', [DishController::class, 'browse'])->name('browse');