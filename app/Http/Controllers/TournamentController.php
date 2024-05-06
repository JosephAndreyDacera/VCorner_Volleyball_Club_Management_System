<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TournamentController extends Controller
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
    public function store(Request $request, $cid)
    {

        $allowed = array('png', 'jpg', 'jpeg', 'gif', 'svg', 'webp');
        if($request->has('tourLogo')){
            $file = $request->file('tourLogo');
            $extension = $file->getClientOriginalExtension();
            $fileName = 'club_logo/'.$cid.'tour_'.time().'.'.$extension;
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

        $name = $request->input('tourName');
        $desc = $request->input('tourDescription');

        DB::table('tournaments')->insert([
            'tour_name' => $name,
            'tour_description' => $desc,
            'tour_c_id' => $cid,
            'tour_logo' => $fileName,
            'tour_status' => 0,
        ]);

        return redirect()->route('club_events',['cid'=>$cid]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $cid, $tour)
    {
        $tourNa = DB::table('tournaments')->where('tour_id', $tour)->get();

        $allowed = array('png', 'jpg', 'jpeg', 'gif', 'svg', 'webp');
        if($request->has('editTourLogo')){
            $file = $request->file('editTourLogo');
            $extension = $file->getClientOriginalExtension();
            $fileName = 'club_logo/'.$cid.'tour_'.time().'.'.$extension;
            if(in_array($extension, $allowed)){
                $file -> move('img/club_logo/',$fileName);
            }else{
                session(["message_error"=>"Invalid image format! Acceptable image format are 'png', 'jpg', 'jpeg', 'gif', 'svg', 'webp'."]);
                return redirect()->route('create_club');
            }
        }else{
            $fileName = $tourNa[0]->tour_logo;
        }

        $name = $request->input('editTourName');
        $desc = $request->input('editTourDescription');

        DB::table('tournaments')
        ->where('tour_id', $tour)
        ->update([
            'tour_name' => $name,
            'tour_description' => $desc,
            'tour_c_id' => $cid,
            'tour_logo' => $fileName,
        ]);

        return redirect()->route('club_events',['cid'=>$cid]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tour, $cid)
    {
        DB::table('matches')->where('match_tour_id',$tour)->delete();

        DB::table('tournaments')->where('tour_id',$tour)->delete();

        return redirect()->route('club_events',['cid'=>$cid]);
    }



    public function viewTournament($tour){

        $tourNa = DB::table('tournaments')->where('tour_id',$tour)->get();
        $club = DB::table('clubs')->where('c_id',$tourNa[0]->tour_c_id)->get();

        if (DB::table('matches')->where('match_tour_id', $tour)->exists()) {
            $match = DB::table('matches')
                    ->where('match_tour_id', $tour)
                    ->get();

            $teams = DB::table('teams')->where('t_c_id', $club[0]->c_id)->get();

        }else{
            $match = 0;
            $teams = 0;
        }

        $allTeams = DB::table('teams')
                ->where('t_c_id', $club[0]->c_id)
                ->get();
        $allMatches = DB::table('matches')
                ->where('match_tour_id', $tour)
                ->get();

        $rankings = [];

        foreach($allTeams as $t){
            $rankTeam = array(0,0,$t->t_name);
            foreach($allMatches as $m){
                if($m->match_winner === $t->t_id){
                    $rankTeam[0] += 1;
                }else{
                    $rankTeam[1] += 1;
                }
            }
            array_push($rankings, $rankTeam);
        }

        sort($rankings);

        return view('pages.view.view_tournament',['tour'=>$tourNa[0],'club'=>$club[0], 'matches'=>$match, 'teams'=>$teams, 'rankings'=>$rankings]);
    }

    public function genRoundRobin($tour){

        $tournament = DB::table('tournaments')->where('tour_id', $tour)->get();

        $teamCount = DB::table('teams')->where('t_c_id',$tournament[0]->tour_c_id)->count();
        $teamList = DB::table('teams')->where('t_c_id',$tournament[0]->tour_c_id)->get();

        $teams = array();

        foreach($teamList as $tl){
            array_push($teams, $tl->t_id) ;
        }

        $numTeams = count($teams);

        $matches = array();

        for ($i = 0; $i < $numTeams - 1; $i++) {
            for ($j = $i + 1; $j < $numTeams; $j++) {
                $matches[] = [$teams[$i], $teams[$j]];
            }
        }

        shuffle($matches);

        // dd($matches);

        foreach($matches as $match){
            DB::table('matches')->insert([
                'match_tour_id' => $tour,
                'match_team1' => $match[0],
                'match_team2' => $match[1]
            ]);
        }

        return redirect()->route('view_tournament', ['tour'=>$tour]);
    }


    public function viewMatch($match){
        $matchInfo = DB::table('matches')->where('match_id', $match)->get();
        $tourNa = DB::table('tournaments')->where('tour_id',$matchInfo[0]->match_tour_id)->get();
        $club = DB::table('clubs')->where('c_id',$tourNa[0]->tour_c_id)->get();
        $team1 = DB::table('teams')
                ->where('t_c_id', $club[0]->c_id)
                ->where('t_id',$matchInfo[0]->match_team1)
                ->get();
        $team2 = DB::table('teams')
                ->where('t_c_id', $club[0]->c_id)
                ->where('t_id',$matchInfo[0]->match_team2)
                ->get();



        if (DB::table('sets')->where('set_match_id', $match)->exists()) {
            $sets = DB::table('sets')
                    ->where('set_match_id', $match)
                    ->get();
        }else{
            $sets = 0;
        }

        return view('pages.view.view_match', ['tour'=>$tourNa[0], 'club'=>$club[0], 'match'=>$matchInfo[0],'team1'=>$team1[0], 'team2'=>$team2[0], 'sets' => $sets]);
    }

    public function updateMatchInfo(Request $request, $match){
        $time = $request->input('matchTime');
        $date = $request->input('matchDate');
        $location = $request->input('matchLocation');
        $desc = $request->input('matchNote');

        DB::table('matches')
            ->where('match_id', $match)
            ->update([
                'match_date' => $date,
                'match_time' => $time,
                'match_location' => $location,
                'match_description' => $desc,
            ]);

        return redirect()->route('view_match',['match'=>$match]);
    }

    public function upateMatchStatus($match, $status){
        DB::table('matches')
        ->where('match_id', $match)
        ->update([
            'match_status'=>$status
        ]);

        return redirect()->route('view_match',['match'=>$match]);
    }

    public function addSet($match){
        $lastSetNo = DB::table('sets')
                ->orderBy('set_number', 'desc')
                ->where('set_match_id',$match)
                ->get();

        if($lastSetNo->isEmpty()){
            DB::table('sets')
            ->insert([
                'set_number'=>1,
                'set_match_id' => $match,
                'set_team1_score'=>0,
                'set_team2_score'=>0,
            ]);
        }else{
            DB::table('sets')
            ->insert([
                'set_number'=> $lastSetNo[0]->set_number+1,
                'set_match_id' => $match,
                'set_team1_score'=>0,
                'set_team2_score'=>0,
            ]);
        }

        return redirect()->route('view_match',['match'=>$match]);
    }

    public function viewSet($set){
        $sets = DB::table('sets')->where('set_id', $set)->get();
        $matchInfo = DB::table('matches')->where('match_id', $sets[0]->set_match_id)->get();
        $tourNa = DB::table('tournaments')->where('tour_id',$matchInfo[0]->match_tour_id)->get();
        $club = DB::table('clubs')->where('c_id',$tourNa[0]->tour_c_id)->get();
        $team1 = DB::table('teams')
                ->where('t_c_id', $club[0]->c_id)
                ->where('t_id',$matchInfo[0]->match_team1)
                ->get();
        $team2 = DB::table('teams')
                ->where('t_c_id', $club[0]->c_id)
                ->where('t_id',$matchInfo[0]->match_team2)
                ->get();

        return view('pages.view.view_set', ['tour'=>$tourNa[0], 'club'=>$club[0], 'match'=>$matchInfo[0],'team1'=>$team1[0], 'team2'=>$team2[0], 'sets' => $sets[0]]);
    }

    public function addTeam1(Request $request){
        $set = $request->setNumber;
        $match = $request->matchID;

        $setInfo = DB::table('sets')->where('set_id', $set)->get();
        DB::table('sets')->where('set_id',$set)
        ->update([
            'set_team1_score' => $setInfo[0]->set_team1_score + 1,
        ]);
        $score = $setInfo[0]->set_team1_score + 1;
        // $setInfo = DB::table('sets')->where('set_id', $set)->get();

        return '<h1 class="score_set text-center">'.$score.'</h1>';
    }


    public function addTeam2(Request $request){
        $set = $request->setNumber;
        $match = $request->matchID;

        $setInfo = DB::table('sets')->where('set_id', $set)->get();
        DB::table('sets')->where('set_id',$set)
        ->update([
            'set_team2_score' => $setInfo[0]->set_team2_score + 1,
        ]);
        $score = $setInfo[0]->set_team2_score + 1;

        return '<h1 class="score_set text-center">'.$score.'</h1>';
    }


    public function minusTeam2(Request $request){
        $set = $request->setNumber;
        $match = $request->matchID;

        $setInfo = DB::table('sets')->where('set_id', $set)->get();
        DB::table('sets')->where('set_id',$set)
        ->update([
            'set_team2_score' => $setInfo[0]->set_team2_score - 1,
        ]);
        $score = $setInfo[0]->set_team2_score - 1;

        return '<h1 class="score_set text-center">'.$score.'</h1>';
    }


    public function minusTeam1(Request $request){
        $set = $request->setNumber;
        $match = $request->matchID;

        $setInfo = DB::table('sets')->where('set_id', $set)->get();
        DB::table('sets')->where('set_id',$set)
        ->update([
            'set_team1_score' => $setInfo[0]->set_team1_score - 1,
        ]);
        $score = $setInfo[0]->set_team1_score - 1;

        return '<h1 class="score_set text-center">'.$score.'</h1>';
    }

    public function endSet(Request $request, $set){
        $setInfo = DB::table('sets')
        ->join('matches', 'matches.match_id', '=', 'sets.set_match_id')
        ->where('set_id', $set)
        ->get();

        $win = $request->input('winnerTeam');

        if($win === $setInfo[0]->match_team1){
            $win = $setInfo[0]->match_team1;
            $lose = $setInfo[0]->match_team2;
        }else{
            $lose = $setInfo[0]->match_team1;
            $win = $setInfo[0]->match_team2;
        }

        DB::table('sets')->where('set_id', $set)
        ->update([
            'set_winner'=>$win,
            'set_loser'=>$lose,
            'set_status'=>1
        ]);

        return redirect()->route('view_set',['set'=>$set]);
    }

    public function endMatch(Request $request, $match){
        $matchInfo = DB::table('matches')
        ->where('match_id', $match)
        ->get();

        $win = $request->input('winnerTeam');

        if($win === $matchInfo[0]->match_team1){
            $win = $matchInfo[0]->match_team1;
            $lose = $matchInfo[0]->match_team2;
        }else{
            $lose = $matchInfo[0]->match_team1;
            $win = $matchInfo[0]->match_team2;
        }

        DB::table('matches')->where('match_id', $match)
        ->update([
            'match_winner'=>$win,
            'match_loser'=>$lose,
            'match_status'=>2
        ]);

        return redirect()->route('view_match',['match'=>$match]);
    }

    public function viewTourStat($tour){

    }


}
