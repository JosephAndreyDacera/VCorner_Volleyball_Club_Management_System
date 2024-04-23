<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/clubs', [App\Http\Controllers\ClubController::class, 'index'])->name('clubs');
Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('events');

Route::get('/create_club', [App\Http\Controllers\ClubController::class, 'create'])->name('create_club');
Route::post('/submit_club', [App\Http\Controllers\ClubController::class, 'store'])->name('store_club');
Route::get('/view_club/{id}', [App\Http\Controllers\ClubController::class, 'viewClub'])->name('view_club');
