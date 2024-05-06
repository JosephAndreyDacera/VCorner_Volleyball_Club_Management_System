<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


// VIEWS
// ====================
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/clubs', [App\Http\Controllers\ClubController::class, 'index'])->name('clubs');
Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('events');

Route::get('/create_club', [App\Http\Controllers\ClubController::class, 'create'])->name('create_club');
Route::get('/view_club/{cid}', [App\Http\Controllers\ClubController::class, 'viewClub'])->name('view_club');
Route::get('/edit_club/{id}', [App\Http\Controllers\ClubController::class, 'editClub'])->name('edit_club');

Route::get('/members/{cid}', [App\Http\Controllers\ClubController::class, 'viewMembers'])->name('members');
Route::get('/teams/{cid}', [App\Http\Controllers\ClubController::class, 'viewTeams'])->name('teams');
Route::get('/statistics/{cid}', [App\Http\Controllers\ClubController::class, 'viewStatistics'])->name('stats');
Route::get('/club_events/{cid}', [App\Http\Controllers\ClubController::class, 'viewEvents'])->name('club_events');
Route::get('/membership_updates', [App\Http\Controllers\ClubController::class, 'client_membership_update'])->name('client_membership_update');
Route::get('/member_settings/{cmid}', [App\Http\Controllers\ClubMembersController::class, 'memberSettings'])->name('member_setting');
Route::get('/update_teams/{tid}', [App\Http\Controllers\ClubController::class, 'viewUpdateTeam'])->name('view_update_team');
Route::get('/tournament/{tour}', [App\Http\Controllers\TournamentController::class, 'viewTournament'])->name('view_tournament');
Route::get('/match/{match}', [App\Http\Controllers\TournamentController::class, 'viewMatch'])->name('view_match');
Route::get('/set/{set}', [App\Http\Controllers\TournamentController::class, 'viewSet'])->name('view_set');
Route::get('/tour_stat/{tour}', [App\Http\Controllers\TournamentController::class, 'viewTourStat'])->name('view_tour_stat');






Route::get('/search_club', [App\Http\Controllers\ClubController::class, 'searchClub'])->name('search_club');
Route::get('/cancel_membership_request/{cid}&{uid}', [App\Http\Controllers\ClubMembersController::class, 'cancel_membership_request'])->name('cancel_membership_request');
Route::get('/remove_member/{cmid}&{cid}', [App\Http\Controllers\ClubMembersController::class, 'removeMember'])->name('remove_member');
Route::get('/reject_member/{mrid}&{cid}', [App\Http\Controllers\ClubMembersController::class, 'rejectMemberRequest'])->name('reject_member');
Route::get('/accept_member/{mrid}&{cid}&{uid}', [App\Http\Controllers\ClubMembersController::class, 'acceptMemberRequest'])->name('accept_member');
Route::get('/remove_from_team/{cmid}&{cid}', [App\Http\Controllers\ClubController::class, 'removeFromTeam'])->name('removeFromTeam');
Route::get('/remove_team/{tid}&{cid}', [App\Http\Controllers\ClubController::class, 'removeTeam'])->name('removeTeam');
Route::get('/remove_tournament/{tour}&{cid}', [App\Http\Controllers\TournamentController::class, 'destroy'])->name('remove_tournament');
Route::get('/automate_matching/{tour}', [App\Http\Controllers\TournamentController::class, 'genRoundRobin'])->name('automate_round_robin');
Route::get('/match_status/{match}&{status}', [App\Http\Controllers\TournamentController::class, 'upateMatchStatus'])->name('match_status');
Route::get('/add_set/{match}', [App\Http\Controllers\TournamentController::class, 'addSet'])->name('add_set');

Route::get('/add_team1', [App\Http\Controllers\TournamentController::class, 'addTeam1'])->name('add_team1');
Route::get('/add_team2', [App\Http\Controllers\TournamentController::class, 'addTeam2'])->name('add_team2');
Route::get('/minus_team2', [App\Http\Controllers\TournamentController::class, 'minusTeam2'])->name('minus_team2');
Route::get('/minus_team1', [App\Http\Controllers\TournamentController::class, 'minusTeam1'])->name('minus_team1');
Route::post('/end_set/{set}', [App\Http\Controllers\TournamentController::class, 'endSet'])->name('end_set');
Route::post('/end_match/{match}', [App\Http\Controllers\TournamentController::class, 'endMatch'])->name('end_match');




// FORM SUBMIT
// ====================

Route::post('/membership_request', [App\Http\Controllers\ClubMembersController::class, 'requestJoin'])->name('requestJoin');
Route::post('/submit_club', [App\Http\Controllers\ClubController::class, 'store'])->name('store_club');
Route::post('/update_club/{id}', [App\Http\Controllers\ClubController::class, 'update'])->name('update_club');
Route::post('/add_team/{cid}', [App\Http\Controllers\ClubController::class, 'addTeam'])->name('add_team');
Route::post('/assign_team/{cmid}&{cid}', [App\Http\Controllers\ClubController::class, 'assignTeam'])->name('assign_team');
Route::post('/update_team/{cid}&{tid}', [App\Http\Controllers\ClubController::class, 'updateTeam'])->name('update_team');
Route::post('/add_tournamen/{cid}', [App\Http\Controllers\TournamentController::class, 'store'])->name('add_tournament');
Route::post('/update_tournament/{cid}&{tour}', [App\Http\Controllers\TournamentController::class, 'update'])->name('update_tournament');
Route::post('/update_match/{match}', [App\Http\Controllers\TournamentController::class, 'updateMatchInfo'])->name('update_match');
