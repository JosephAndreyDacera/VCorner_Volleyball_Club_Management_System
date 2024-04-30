<?php

namespace App\Http\Controllers;

use App\Models\ClubMembers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClubMembersController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function requestJoin(Request $request)
    {

        $user = Auth::user();
        $uid=$user->id;
        $club_code = $request->input("inviteCode");

       $club = DB::table('clubs')
            ->where('c_invite_code', '=', $club_code)
            ->get();

        if(!$club->isEmpty()){
            $dups = DB::table('membership_requests')
            ->where('mr_c_id', '=', $club[0]->c_id)
            ->get();

            if ($dups->isEmpty()) {
                DB::table('membership_requests')->insert([
                    'mr_u_id' => $uid,
                    'mr_c_id' => $club[0]->c_id,
                ]);
                session(['message_success' => 'Membership request was sent successfully! Please wait for the club manager to review your request.']);
            }else{
                session(['message_warning' => "You have pending request on this club. Please wait for the club manager to review your request."]);
            }
        }else{
            session(['message_error' => "Club invotation code doesn't exist! Please ask for the correct invitation code."]);
        }
        return redirect()->route('clubs');
    }

    public function cancel_membership_request($cid, $uid){

        DB::table('membership_requests')
        ->where('mr_c_id', '=', $cid)
        ->where('mr_u_id', '=', $uid)
        ->delete();

        return redirect()->route('client_membership_update');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClubMembers $clubMembers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClubMembers $clubMembers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClubMembers $clubMembers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClubMembers $clubMembers)
    {
        //
    }
}
