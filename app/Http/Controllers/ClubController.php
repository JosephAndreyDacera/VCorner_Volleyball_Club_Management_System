<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
    public function index(){
        $user = Auth::user();
        $uid=$user->id;

        // $userClubs = DB::table('club_members')
        // ->select('c_id','c_name','c_address','c_invite_code', 'c_logo')
        // ->join('clubs', 'club_members.cm_c_id', '=', 'clubs.c_id')
        // ->join('users', 'club_members.cm_u_id', '=', 'users.id')
        // ->where('users.id', '=', $uid)
        // ->get();

        $userClubs = DB::table('clubs')
        ->select('c_id','c_name','c_address','c_invite_code', 'c_logo')
        ->where('c_u_id', '=', $uid)
        ->get();

        // dd($userClubs);


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
    public function create(){
        return view('pages.create.clubs_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $allowed = array('png', 'jpg', 'jpeg', 'gif', 'svg', 'webp');

        $user = Auth::user();
        $uid=$user->id;

        $clubName = $request->input('clubName');
        $clubAddress = $request->input('clubAddress');
        $clubEmail = $request->input('clubEmail');
        $clubMobile = $request->input('clubMobile');
        $clubFounded = $request->input('clubFounded');

        $random = rand(0,9);
        $random2 = rand(0,9);
        $sp = rand(0,4);
        $special = array('@','$','#','&','%');
        $clubCode = Str::upper($random2.$clubMobile[0].$clubName[0].$special[$sp].$clubEmail[0].$uid.$clubAddress[0].$random.'');


        if($request->has('clubLogo')){
            $file = $request->file('clubLogo');
            $extension = $file->getClientOriginalExtension();
            $fileName = 'club_logo/'.$uid.'_'.time().'.'.$extension;
            if(in_array($extension, $allowed)){
                $file -> move('img/club_logo/',$fileName);
            }else{
                session(["message_error"=>"Invalid image format! Acceptable image format are 'png', 'jpg', 'jpeg', 'gif', 'svg', 'webp'."]);
                return redirect()->route('create_club');
            }
        }else{
            $num = rand(1, 8);
            $fileName = "club_logo/club".$num.".png";
        }

        DB::table('clubs')->insert([
            'c_name' => $clubName,
            'c_date_founded' => $clubFounded,
            'c_address' => $clubAddress,
            'c_email' => $clubEmail,
            'c_mobile' => $clubMobile,
            'c_invite_code' => $clubCode,
            'c_logo' => $fileName,
            'c_u_id' => $uid
        ]);

        session(["message_success" => $clubName." was created successfully!"]);

        return redirect()->route('clubs');
    }

    public function viewClub($id){

        $club = DB::table('clubs')
        ->where('c_id', '=', $id)
        ->get();

        // if(!$club->isEmpty()){
        //     dd($club[0]);
        // }


        return view('pages.view.view_club', ['clubInfo' => $club]);
    }


    public function viewMembers($cid){
        return view('pages.view.members');
    }


    public function viewTeams($cid){
        return view('pages.view.view_club');
    }


    public function viewStatistics($cid){
        return view('pages.view.view_club');
    }


    public function viewEvents($cid){
        return view('pages.view.view_club');
    }

    public function searchClub(Request $request){

        $user = Auth::user();
        $uid=$user->id;
        $searchResult = "";


        $uc = DB::table('club_members')
        ->select('c_id')
        ->join('clubs', 'club_members.cm_c_id', '=', 'clubs.c_id')
        ->join('users', 'club_members.cm_u_id', '=', 'users.id')
        ->where('users.id', '=', $uid);

        if($request->searchClub == ""){

            $otherClubs = DB::table('clubs')
            ->whereNotIn('c_id', $uc)
            ->get();

        } else {

            $otherClubs = DB::table('clubs')
            ->whereNotIn('c_id', $uc)
            ->where('c_name', 'Like', '%'.$request->searchClub.'%')
            ->get();

            if($otherClubs->isEmpty()){
                $searchResult = '
                <div class="alert alert-danger alert-dismissible fade show align-items-center text-center" role="alert">
                    The club name you\'re trying to search does not exist!
                </div>';
            }

        }

        foreach($otherClubs as $club){
            $searchResult .= '<div class="col-md-3 col-sm-6 col-xs-12 d-flex align-items-stretch mb-3">
                <div class="card ms-auto me-auto w-100 club_card">
                    <div class="m-auto w-auto">
                        <img src="'.(url('/').'/img/'.$club->c_logo).'" class="card-img-top card_image" alt="Card Image">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5>'.$club->c_name.'</h5>
                        <h6>'.$club->c_address.'</h6>
                    </div>
                </div>
            </div>';
        }



        return response($searchResult);
    }


    public function client_membership_update(){
        $user = Auth::user();
        $uid=$user->id;

        $memberRequest = DB::table('membership_requests')
        ->join('clubs', 'membership_requests.mr_c_id', '=', 'clubs.c_id')
        ->where('mr_u_id', $uid)
        ->get();

        return view('pages.view.client_membership_updates',['memberRequest'=>$memberRequest]);
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
