<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClubController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $uid=$user->id;

        $userClubs = DB::table('club_members')
        ->select('c_id','c_name','c_address','c_invite_code', 'c_logo')
        ->join('clubs', 'club_members.cm_c_id', '=', 'clubs.c_id')
        ->join('users', 'club_members.cm_u_id', '=', 'users.id')
        ->where('users.id', '=', $uid)
        // ->where('cm_ui_id', '=', $uid->id)
        ->get();


        $uc = DB::table('club_members')
        ->select('c_id')
        ->join('clubs', 'club_members.cm_c_id', '=', 'clubs.c_id')
        ->join('users', 'club_members.cm_u_id', '=', 'users.id')
        ->where('users.id', '=', $uid);

        $otherClubs = DB::table('clubs')
        ->whereNotIn('c_id', $uc)
        ->get();

        return view('pages.view.clubs',['userClubs'=>$userClubs, 'otherClubs'=>$otherClubs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create.clubs_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function viewClub($id){
        return view('pages.view.view_club');
    }

    /**
     * Display the specified resource.
     */
    public function show(Club $club)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Club $club)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Club $club)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Club $club)
    {
        //
    }
}
