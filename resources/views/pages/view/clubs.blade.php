@extends('layouts.home_layout')

@section('content')
{{-- <section class="mt-4 mb-5">
    <br><br>
    <div class="container">
        <a href="#" class="btn btn-success float-end ms-1 me-1 btn_bg_secondary"><span><i class="fa-solid fa-user-plus me-2"></i></span>Join Club</a>
        <a href="#" class="btn btn-primary float-end ms-1 me-1 btn_bg_primary"><span><i class="fa-solid fa-square-plus me-2"></i></span>Create Club</a>
    </div>
</section> --}}
<section class="mb-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mb-2">
                <h3>My Clubs</h3>
            </div>
            <div class="col-md-4 mb-2">
                {{-- <a href="#" class="btn btn-success float-end ms-1 me-1"><span><i class="fa-solid fa-user-plus me-2"></i></span>Join Club</a> --}}
                <button type="button" class="btn btn-success float-end ms-1 me-1" data-bs-toggle="modal" data-bs-target="#joinClubModal"><i class="fa-solid fa-user-plus me-2"></i></span>Join Club</button>
                <a href="{{route('create_club')}}" class="btn btn-primary float-end ms-1 me-1"><span><i class="fa-solid fa-square-plus me-2"></i></span>Create Club</a>
            </div>
        </div>
        <hr>
        @if (session()->has('message_success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo session()->get('message_success'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php session()->forget('message_success'); ?>
        @endif

        @if (session()->has('message_warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo session()->get('message_warning'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php session()->forget('message_warning'); ?>
        @endif

        @if (session()->has('message_error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo session()->get('message_error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php session()->forget('message_error'); ?>
        @endif



        <a href="{{route('client_membership_update')}}" class="btn btn-secondary text-white float-end me-1">
            <span><i class="fa-solid fa-square-pen"></i></span> Membership Request Updates
        </a>
        <br>
        <div class="mt-5 row">
            @foreach ($userClubs as $userClub)
                <div class="col-md-3 col-sm-6 col-xs-12 d-flex align-items-stretch mb-3">
                    <a href="{{route('view_club',['cid'=>$userClub->c_id])}}" class="text-black text-decoration-none">
                        <div class="card ms-auto me-auto w-100 club_card">
                            <div class="m-auto w-auto">
                                <img src="{{asset('img/'.$userClub->c_logo)}}" class="card-img-top card_image" alt="Card Image">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5>{{$userClub->c_name}}</h5>
                                <h6>{{$userClub->c_address}}</h6>
                                <h6>Invite Code: <b>{{$userClub->c_invite_code}}</b></h6>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <form action="{{route('requestJoin')}}" method="post">
            @csrf
            <div class="modal fade" id="joinClubModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h4 class="modal-title card_header_font text-center" id="exampleModalLabel">Join Club Using Invitation Code</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="inviteCode" class="form-label"><b>Club Invitation Code</b></label>
                                <h6 class="form-text">You can ask your club managers or members for the invitation code and enter it on the club invation code field.</h6>
                                <h6 class="form-text">Once you submit the code, club managers will review your request to join the club. </h6>
                                <input type="text" class="form-control input_font" id="inviteCode" name="inviteCode" placeholder="Input club invitation code...">
                                <br>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Request to Join</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="mb-5 mt-5">
    <div class="container mt-5">
        <br>
        <div class="row">
            <div class="col-md-8 mb-2">
                <h3>Discover</h3>
            </div>
            <div class="col-md-4 mb-2">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="searchClub" id="searchClub" placeholder="Search club name..." aria-label="Search club" aria-describedby="basic-addon2">
                    <span class="input-group-text bg-primary" id="basic-addon2"><i class="fa-solid fa-magnifying-glass text-white"></i></span>
                </div>
            </div>
        </div>

        <hr>
        <div class="row" id="searchResult">
            @foreach ($otherClubs as $otherClub)
                <div class="col-md-3 col-sm-6 col-xs-12 d-flex align-items-stretch mb-3">
                    <div class="card ms-auto me-auto w-100 club_card">
                        <div class="m-auto w-auto">
                            <img src="{{asset('img/'.$otherClub->c_logo)}}" class="card-img-top card_image" alt="Card Image">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5>{{$otherClub->c_name}}</h5>
                            <h6>{{$otherClub->c_address}}</h6>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>

<script type="text/javascript">
    $('#searchClub').on('keyup', function(){
        $value = $(this).val();

        $.ajax({
            type:'get',
            url:'{{URL::to('search_club')}}',
            data:{'searchClub':$value},

            success:function(data){
                // console.log(data);
                $('#searchResult').html(data);
            }
        });


    });
</script>
@endsection
