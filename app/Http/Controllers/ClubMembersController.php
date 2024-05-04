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
    public function __construct(){
        $this->middleware('auth');
    }


    function requestJoin(Request $request){

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


    public function removeMember($cmid,$cid){
        DB::table('club_members')->where('cm_id', '=', $cmid)->delete();
        return redirect()->route('members',['cid'=>$cid]);
    }


    public function rejectMemberRequest($mrid, $cid){
        DB::table('membership_requests')->where('mr_id', '=', $mrid)->delete();
        return redirect()->route('members',['cid'=>$cid]);
    }


    public function acceptMemberRequest($mrid, $cid, $uid){
        $currentDate = date('m-d-Y');
        $memType = DB::table('membership_types')
                    ->where('mt_type', '=', 'Regular')
                    ->get();

        DB::table('club_members')->insert([
            'cm_date_joined' => $currentDate,
            'cm_u_id' => $uid,
            'cm_c_id' => $cid,
            'cm_mt_id' => $memType[0]->mt_id
        ]);

        DB::table('membership_requests')->where('mr_id', '=', $mrid)->delete();

        return redirect()->route('members',['cid'=>$cid]);
    }


    public function memberSettings($cmid){
        $member = DB::table('club_members')
                ->join('users', 'users.id', '=', 'club_members.cm_u_id')
                ->join('user_information', 'user_information.ui_u_id', '=', 'users.id')
                ->get();

        return view('pages.update.members_settings',['member'=>$member[0]]);
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
