@extends('layouts.manage_club')

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
            <li class="breadcrumb-item active" aria-current="page"
                    style="font-family: sans-serif;
                    font-size: 1rem;
                    font-weight: bold;">
                Club Name
            </li>
        </ol>
    </nav>
    <div class="row mt-4">
        <div class="col-md-6 col-lg-6 col-sm-12  align-items-stretch mb-3">
            <div class="card ms-auto me-auto w-100 shadow">
                <div class="card-body bg_blue d-flex flex-column">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                            <a href="{{route('edit_club', ['id'=> $clubInfo[0]->c_id])}}" class="btn btn-warning float-end"> <span><i class="fa-solid fa-edit"> </i></span> </a>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 mb-4">
                            <?php
                                $logoStr = $clubInfo[0]->c_logo;
                            ?>
                            <img src="{{asset('img/'.$logoStr)}}" alt="" srcset="" class="club_view_img rounded mx-auto d-block">
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 mb-3 text-center">
                            <h3 class="text-white"><?= $clubInfo[0]->c_name ?></h3>
                            <h6 class="text-white mb-3">Date Founded: <?= $clubInfo[0]->c_date_founded  ?></h6>
                            <h5 class="text-white">Invitation Code: <u><b><?= $clubInfo[0]->c_invite_code  ?></b></u> </h5>
                        </div>
                        <hr class="mt-3 mb-3" style="border:2px solid white">
                        <div class="col-md-12 col-lg-12 col-sm-12 mb-3 ps-lg-5 pe-lg-5">
                            <h5 class="text-white "><span><i class="fa-solid fa-location-dot me-4 ms-1" style="color: white; font-size:1.5rem;"></i></span><?= $clubInfo[0]->c_address  ?></h5>
                            <h5 class="text-white"><span><i class="fa-solid fa-envelope me-4" style="color: white; font-size:1.5rem;"></i></span><?= $clubInfo[0]->c_email  ?></h5>
                            <h5 class="text-white"><span><i class="fa-solid fa-mobile me-4 ms-1" style="color: white; font-size:1.5rem;"></i></span><?= $clubInfo[0]->c_mobile  ?></h5>
                            <h5 class="text-white"><span><i class="fa-brands fa-square-facebook me-4 ms-1" style="color: white; font-size:1.5rem;"></i></span><a href="<?= $clubInfo[0]->c_facebook  ?>" class="text-white"><i>Facebook</i></a></h5>
                            <h5 class="text-white"><span><i class="fa-brands fa-square-instagram me-4 ms-1" style="color: white; font-size:1.5rem;"></i></span><a href="<?= $clubInfo[0]->c_instagram  ?>" class="text-white"><i>Instagram</i></a></h5>
                            <h5 class="text-white"><span><i class="fa-brands fa-square-x-twitter me-4 ms-1" style="color: white; font-size:1.5rem;"></i></span><a href="<?= $clubInfo[0]->c_x  ?>" class="text-white"><i>X - Twitter</i></a></h5>
                            <h5 class="text-white"><span><i class="fa-brands fa-square-youtube me-4 ms-1" style="color: white; font-size:1.5rem;"></i></span><a href="<?= $clubInfo[0]->c_youtube  ?>" class="text-white"><i>YouTube</i></a></h5>
                            <h5 class="text-white"><span><i class="fa-solid fa-globe me-4 ms-1" style="color: white; font-size:1.4rem;"></i></span><a href="<?= $clubInfo[0]->c_website  ?>" class="text-white"><i>Website</i></a></h5>
                        </div>
                        {{-- <hr style="border:2px solid white"> --}}
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12 align-items-stretch mb-3">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 d-flex align-items-stretch mb-3">
                    <div class="card ms-auto me-auto w-100 card_club_info shadow" style="border-bottom: 5px solid orange;">
                        <a href="{{route('members',['cid' => 1])}}" class="card_link">
                            <div class="card-body p-4 text-center">
                                <i class="fa-solid fa-users fa-5x mt-3" style="color: orange;"></i>
                                <h3 class="mt-2 text-center">Members</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 d-flex align-items-stretch mb-3">
                    <div class="card ms-auto me-auto w-100 card_club_info shadow" style="border-bottom: 5px solid #088F8F;">
                        <a href="{{route('teams',['cid' => 1])}}" class="card_link">
                            <div class="card-body p-4 text-center">
                                <i class="fa-solid fa-users-line fa-5x mt-3" style="color: #088F8F;"></i>
                                <h3 class="mt-2 text-center">Teams</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 d-flex align-items-stretch mb-3" >
                    <div class="card ms-auto me-auto w-100 card_club_info shadow" style="border-bottom: 5px solid blue;">
                        <a href="{{route('stats',['cid' => 1])}}" class="card_link">
                            <div class="card-body p-4 text-center">
                                <i class="fa-solid fa-chart-pie fa-5x mt-3" style="color: blue;"></i>
                                <h3 class="mt-2 text-center">Statistics</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 d-flex align-items-stretch mb-3">
                    <div class="card ms-auto me-auto w-100 card_club_info shadow" style="border-bottom: 5px solid #FFBF00;">
                        <a href="{{route('club_events',['cid' => 1])}}" class="card_link">
                            <div class="card-body p-4 text-center">
                                <i class="fa-solid fa-trophy fa-5x mt-3" style="color: #FFBF00;"></i>
                                <h3 class="mt-2 text-center">Tournaments</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
