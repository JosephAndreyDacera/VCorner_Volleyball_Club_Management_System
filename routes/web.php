<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/clubs', [App\Http\Controllers\ClubController::class, 'index'])->name('clubs');
Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('events');

Route::get('/create_club', [App\Http\Controllers\ClubController::class, 'create'])->name('create_club');
Route::get('/view_club/{id}', [App\Http\Controllers\ClubController::class, 'viewClub'])->name('view_club');

// VIEWS
// ====================
Route::get('/members/{cid}', [App\Http\Controllers\ClubController::class, 'viewMembers'])->name('members');
Route::get('/teams/{cid}', [App\Http\Controllers\ClubController::class, 'viewTeams'])->name('teams');
Route::get('/statistics/{cid}', [App\Http\Controllers\ClubController::class, 'viewStatistics'])->name('stats');
Route::get('/club_events/{cid}', [App\Http\Controllers\ClubController::class, 'viewEvents'])->name('club_events');
Route::get('/membership_updates', [App\Http\Controllers\ClubController::class, 'client_membership_update'])->name('client_membership_update');


Route::get('/search_club', [App\Http\Controllers\ClubController::class, 'searchClub'])->name('search_club');
Route::get('/cancel_membership_request/{cid}&{uid}', [App\Http\Controllers\ClubMembersController::class, 'cancel_membership_request'])->name('cancel_membership_request');



// FORM SUBMIT
// ====================

Route::post('/membership_request', [App\Http\Controllers\ClubMembersController::class, 'requestJoin'])->name('requestJoin');
Route::post('/submit_club', [App\Http\Controllers\ClubController::class, 'store'])->name('store_club');
