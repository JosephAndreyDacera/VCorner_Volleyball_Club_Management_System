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
        <div class="row pt-5 mb-5">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <img src="{{asset('img/'.$tour->tour_logo)}}" class="card-img-top" style="height: auto; width: 100%" alt="Card Image">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12">
                <h4 class="text-center mb-3"><?= $club->c_name ?></h4>
                <h2 class="text-center"><?= $tour->tour_name?></h2>
                <h4 class="text-center"><?= $tour->tour_description?></h4>

            </div>
        </div>
        <div class="row pt-5">
            <div class="col-md-8 col-lg-8 col-sm-6">
                <h3><i class="fa-solid fa-volleyball"></i> Matches</h3>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-6">
                @if (!$matches)
                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#automateMatch">
                        <i class="fa-solid fa-robot"></i> Automate Match Making</button>

                    <!-- Modal -->
                    <div class="modal fade" id="automateMatch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Automate Match Making</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5>
                                    This will automatically create match pairings for a <i>"Single Round Robin"</i> tournament.
                                </h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                <a href="{{route('automate_round_robin',['tour'=>$tour->tour_id])}}" class="btn btn-primary">Continue</a>
                            </div>
                        </div>
                        </div>
                    </div>
                @else
                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addMatch">
                        <i class="fa-solid fa-square-plus"></i> Add Match</button>

                        <div class="modal fade" id="addMatch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Automate Match Making</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{-- <h5>
                                        This will automatically create match pairings for a <i>"Single Round Robin"</i> tournament.
                                    </h5> --}}
                                    <h5>Currently building this feature</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                    <a href="#" class="btn btn-primary">Continue</a>
                                </div>
                            </div>
                            </div>
                        </div>
                @endif
            </div>
        </div>
        <hr>
        <div class="row">
            {{-- Matches --}}
            <div class="col-lg-8 col-md-6 col-sm-12 p-4">
                @if (!$matches)
                    <h5 class="text-center text-secondary mt-5">No matches found!</h5>
                @else
                    <div class="row">
                        <?php
                            $team1 = '';
                            $team1_logo = '';

                            $team2 = '';
                            $team2_logo = '';
                        ?>
                        @foreach ($matches as $match)
                            @foreach ($teams as $team)
                                @if ($team->t_id == $match->match_team1)
                                    <?php
                                        $team1 = $team->t_name;
                                        $team1_logo = $team->t_logo;
                                    ?>
                                @endif
                                @if ($team->t_id == $match->match_team2)
                                    <?php
                                        $team2 = $team->t_name;
                                        $team2_logo = $team->t_logo;
                                    ?>
                                @endif
                            @endforeach
                            <div class="col-md-6 col-lg-6 col-sm-12 mb-5">
                                <div class="card shadow club_card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2 col-lg-2 col-sm-3 col-xs-4 mb-2">
                                                <img src="{{asset('img/'.$team1_logo)}}" style="width: 50px; height: auto;" alt="Team Logo">
                                            </div>
                                            <div class="col-md-10 col-lg-10 col-sm-9 col-xs-8 mb-2">
                                                <h4 style="color: blue;"><?= $team1 ?></h4>
                                            </div>
                                        </div>
                                        <h5 class="text-center" style="color: red;">Versus</h5>
                                        <div class="row">
                                            <div class="col-md-2 col-lg-2 col-sm-3 col-xs-4 mt-2">
                                                <img src="{{asset('img/'.$team2_logo)}}" style="width: 50px; height: auto;" alt="Team Logo">
                                            </div>
                                            <div class="col-md-10 col-lg-10 col-sm-9 col-xs-8 mt-2">
                                                <h4 style="color: green;"><?= $team2 ?></h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 col-sm-12">
                                                <h6>Date:&nbsp;&nbsp; <?= $match->match_date?></h6>
                                                <h6>Time:&nbsp;&nbsp; <?= $match->match_time?></h6>
                                                <h6>Location:  <?= $match->match_location?></h6>
                                                <hr>
                                                <h6>Note:  <?= $match->match_description?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{route('view_match',[$match->match_id])}}" class="btn btn-primary float-end"><i class="fa-solid fa-eye"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 p-4">
                <h5 class="text-center">Rankings</h5>
                <div class="mb-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Team</th>
                                <th>Win</th>
                                <th>Lose</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $rCount = 1; ?>
                            @foreach ($rankings as $rank)
                                <tr>
                                    <td><?=$rCount?></td>
                                    <td><?=$rank[2]?></td>
                                    <td><?=$rank[0]?></td>
                                    <td><?=$rank[1]?></td>
                                </tr>
                                <?php $rCount += 1; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="mt-5 text-center">
                    <h5 class="mb-3">Player Statistics</h5>
                    <a href="#" class="btn btn-primary"><i class="fa-solid fa-chart-column"></i> View Player Stats</a>
                </div>
            </div>
        </div>
        <br><br><br>
        <hr>
        <div class="row mt-5">
            <div class="col-md-3 col-lg-3 col-sm-8 m-auto text-center">
                <button type="button" class="btn btn-success"><i class="fa-solid fa-check-to-slot"></i> Conclude Tournament</button>
            </div>
        </div>
    </div>
    <br><br><br>
    <br><br><br>
    <br><br><br>
@endsection
