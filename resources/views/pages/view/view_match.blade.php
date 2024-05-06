@extends('layouts.home_layout')
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('clubs')}}"
                        style="font-family: sans-serif;
                        font-size: 1rem;
                        font-weight: bold;">
                    My Clubs</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('view_club',['cid'=>$tour->tour_c_id])}}"
                        style="font-family: sans-serif;
                        font-size: 1rem;
                        font-weight: bold;">
                    <?= $club->c_name?></a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('club_events',['cid'=>$tour->tour_c_id])}}"
                        style="font-family: sans-serif;
                        font-size: 1rem;
                        font-weight: bold;">
                    Tournaments
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"
                        style="font-family: sans-serif;
                        font-size: 1rem;
                        font-weight: bold;">
                        <?= $tour->tour_name ?>
                </li>
            </ol>
        </nav>
        <div class="row mt-5">
            <div class="col-md-8 col-lg-8 col-sm-6">
                <h3><i class="fa-solid fa-volleyball"></i> Match</h3>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-6">
                <a href="{{route('view_tournament', ['tour'=>$tour->tour_id])}}" class="btn btn-primary float-end"><i class="fa-solid fa-circle-arrow-left"></i> Go Back</a>
            </div>
        </div>
        <hr>
        <div class="row mt-5 mb-5">
            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h4 class="text-center"><b style="color: blue;"><?= $team1->t_name ?></b></h4>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 m-auto">
                        <h2 class="text-center"><b>VS</b></h2>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h4 class="text-center"><b style="color: red;"><?= $team2->t_name ?></b></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">

            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 pt-1">
                <div>
                    <img src="{{asset('img/'.$team1->t_logo)}}" style="width: 100%; height: auto;" alt="Team Logo">
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 pt-1">
                <div>
                    <img src="{{asset('img/'.$team2->t_logo)}}" style="width: 100%; height: auto;" alt="Team Logo">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 ps-5 pe-5">
                <h5>Date:&nbsp;&nbsp; <?= $match->match_date?></h5>
                <h5>Time:&nbsp;&nbsp; <?= $match->match_time?></h5>
                <h5>Location:  <?= $match->match_location?></h5>
                <hr>
                <h5>Note:  <?= $match->match_description?></h5>
                <hr>
                @if (!$match->match_status)
                    <a href="{{route('match_status',['match'=>$match->match_id, 'status'=>1])}}" class="btn btn-primary me-2"><i class="fa-solid fa-play"></i> Start Match </a>
                @else
                    <button class="btn btn-primary me-2" disabled><i class="fa-solid fa-play"></i> Start Match </button>
                @endif
                @if ($match->match_status === 1)
                    <!-- Button trigger modal -->
                    <button type="button" class="btn  btn-danger me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-solid fa-stop"></i> End Match
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{route('end_match',['match'=>$match->match_id])}}" method="post">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">End Match</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>You are about to end the match, after ending the set you will be unable to edit the sets. Are you sure you wish to continue?</h5>
                                        <hr>
                                        <label for="winnerTeam" class="form-label"><b>Winner</b></label>
                                        <select name="winnerTeam" id="winnerTeam" class="form-control">
                                            <option value="<?=$team1->t_id?>"><?=$team1->t_name?></option>
                                            <option value="<?=$team2->t_id?>"><?=$team2->t_name?></option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Continue</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- <a href="{{route('match_status',['match'=>$match->match_id, 'status'=>2])}}" class="btn btn-danger me-2"><i class="fa-solid fa-stop"></i> End Match </a> --}}
                    <button type="button" class="btn btn-success me-2"  data-bs-toggle="modal" data-bs-target="#editInfoModal" disabled><i class="fa-solid fa-pen-to-square"></i> Edit Information</button>
                @else
                    @if ($match->match_status === 0 || $match->match_status === 2)
                        <button class="btn btn-danger me-2" disabled><i class="fa-solid fa-stop"></i> End Match </button>

                    @endif
                    @if ($match->match_status === 0)
                    <button type="button" class="btn btn-success me-2"  data-bs-toggle="modal" data-bs-target="#editInfoModal"><i class="fa-solid fa-pen-to-square"></i> Edit Information</button>
                    @else

                    <button class="btn btn-success me-2" disabled><i class="fa-solid fa-pen-to-square"></i> Edit Information</button>
                    @endif
                @endif
            </div>

            <div class="modal fade" id="editInfoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{route('update_match',['match'=>$match->match_id])}}" method="post">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Match Information</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="p-3">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="matchDate" class="form-label"><b>Date</b></label>
                                                <input type="date" class="form-control" id="matchDate" name="matchDate" value="<?=$match->match_date?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="matchTime" class="form-label"><b>Time</b></label>
                                                <input type="time" class="form-control" id="matchTime" name="matchTime" value="<?=$match->match_time?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="matchLocation" class="form-label"><b>Location</b></label>
                                        <input type="text" class="form-control" id="matchLocation" name="matchLocation" value="<?=$match->match_location?>" placeholder="Location" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="matchNote" class="form-label"><b>Note</b></label>
                                        <input type="text" class="form-control" id="matchNote" name="matchNote" value="<?=$match->match_description?>" placeholder="Note">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
        <br>
        <div class="row mt-5">
            <div class="col-md-8 col-lg-8 col-sm-6">
                <h3><i class="fa-solid fa-volleyball"></i> Sets</h3>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-6">
                @if ($match->match_status === 1)
                    <a href="{{route('add_set',['match'=>$match->match_id])}}" class="btn btn-primary float-end"><i class="fa-solid fa-square-plus"></i> Add Set</a>
                @endif
            </div>
        </div>
        <hr>
        <div class="row mt-5">
            @foreach ($sets as $set)
                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                    <div class="card pt-2 club_card shadow">
                        <a href="{{route('view_set', ['set'=>$set->set_id])}}" class="text-black text-decoration-none">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 pb-2">
                                        <h4 class="text-center"  style="color: green;">SET NO. <?=$set->set_number?></h4>
                                    </div>
                                    <hr>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <h5 class="text-center" style="color: blue;"><?=$team1->t_name ?></h5>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <h1 class="text-center"><?=$set->set_team1_score?></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <h5 class="text-center" style="color: red;"><?=$team2->t_name ?></h5>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <h1 class="text-center"><?=$set->set_team2_score?></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <br><br><br>
        <br><br><br>
    </div>
@endsection
