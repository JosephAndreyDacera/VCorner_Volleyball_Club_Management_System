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
                <h3><i class="fa-solid fa-volleyball"></i> Set No. <?= $sets->set_id?></h3>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-6">
                <a href="{{route('view_match', ['match'=>$match->match_id])}}" class="btn btn-primary float-end"><i class="fa-solid fa-circle-arrow-left"></i> Go Back</a>
            </div>
        </div>
        <hr>
        <div class="row mt-5">
            <input type="number" value="<?=$sets->set_number?>" id="setNumber" hidden>
            <input type="number" value="<?=$sets->set_match_id?>" id="matchID" hidden>
            <div class="card">
                <div class="card-body">
                    <div class="row mt-3 mb-3">
                        <div class="col-md-5 col-lg-5 col-sm-12">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <h4 class="text-center" style="font-size: 2.5rem; color: blue;"><?= $team1->t_name ?></h4>
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <div id="team1Score">
                                        <h1 class="score_set text-center"><?=$sets->set_team1_score?></h1>
                                    </div>
                                </div>
                                @if ($sets->set_status === 0)
                                    <div class="row mt-5">
                                        <div class="col-md-6 col-lg-6">
                                            <button type="button" id="minusTeam1" class="btn btn-danger w-100"><i class="fa-solid fa-square-minus"></i> Minus</button>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <button type="button" id="addTeam1" class="btn btn-primary w-100"><i class="fa-solid fa-square-plus"></i> Add</button>
                                        </div>
                                    </div>
                                    {{-- Add Team 1 Score --}}
                                    <script type="text/javascript">
                                        $('#addTeam1').on('click', function(){
                                            $setNum = $('#setNumber').val();
                                            $matchID = $('#matchID').val();

                                            $.ajax({
                                                type:'get',
                                                url:'{{URL::to('add_team1')}}',
                                                data:{'setNumber':$setNum,
                                                        'matchID':$matchID},

                                                success:function(data){
                                                    $('#team1Score').html(data);
                                                }
                                            });
                                        });
                                    </script>

                                    {{-- Minus Team 1 Score --}}
                                    <script type="text/javascript">
                                        $('#minusTeam1').on('click', function(){
                                            $setNum = $('#setNumber').val();
                                            $matchID = $('#matchID').val();

                                            $.ajax({
                                                type:'get',
                                                url:'{{URL::to('minus_team1')}}',
                                                data:{'setNumber':$setNum,
                                                        'matchID':$matchID},

                                                success:function(data){
                                                    $('#team1Score').html(data);
                                                }
                                            });
                                        });
                                    </script>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 col-lg-2 col-sm-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <hr>
                                </div>
                                <div class="col-lg-12">
                                    <h2 class="text-center " style="font-size: 5rem;color: green;">VS</h2>
                                </div>
                                <div class="col-lg-12">
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-lg-5 col-sm-12">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <h4 class="text-center" style="font-size: 2.5rem; color: red;"><?= $team2->t_name ?></h4>
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <div id="team2Score">
                                        <h1 class="score_set text-center"><?=$sets->set_team2_score?></h1>
                                    </div>
                                </div>
                                @if ($sets->set_status === 0)
                                    <div class="row mt-5">
                                        <div class="col-md-6 col-lg-6">
                                            <button type="button" id="minusTeam2" class="btn btn-danger w-100"><i class="fa-solid fa-square-minus"></i> Minus</button>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <button type="button" id="addTeam2" class="btn btn-primary w-100"><i class="fa-solid fa-square-plus"></i> Add</button>
                                        </div>
                                    </div>

                                    {{-- Add Team 2 Score --}}
                                    <script type="text/javascript">
                                        $('#addTeam2').on('click', function(){
                                            $setNum = $('#setNumber').val();
                                            $matchID = $('#matchID').val();

                                            $.ajax({
                                                type:'get',
                                                url:'{{URL::to('add_team2')}}',
                                                data:{'setNumber':$setNum,
                                                        'matchID':$matchID},

                                                success:function(data){
                                                    $('#team2Score').html(data);
                                                }
                                            });
                                        });
                                    </script>

                                    {{-- Minus Team 2 Score --}}
                                    <script type="text/javascript">
                                        $('#minusTeam2').on('click', function(){
                                            $setNum = $('#setNumber').val();
                                            $matchID = $('#matchID').val();

                                            $.ajax({
                                                type:'get',
                                                url:'{{URL::to('minus_team2')}}',
                                                data:{'setNumber':$setNum,
                                                        'matchID':$matchID},

                                                success:function(data){
                                                    $('#team2Score').html(data);
                                                }
                                            });
                                        });
                                    </script>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row mt-5">

                        @if ($sets->set_status === 0)<!-- Button trigger modal -->
                            <button type="button" class="btn btn-success m-auto w-25" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa-solid fa-square-check"></i> End Set
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{route('end_set',['set'=>$sets->set_id])}}" method="POST">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">End Set</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>You are about to end the set, after ending the set you will be unable to edit the scores. Are you sure you wish to continue?</h5>
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
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
