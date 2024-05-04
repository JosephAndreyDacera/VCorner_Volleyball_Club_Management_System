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
                <li class="breadcrumb-item"><a href="{{route('view_club',['cid'=>$club->c_id])}}"
                        style="font-family: sans-serif;
                        font-size: 1rem;
                        font-weight: bold;">
                    <?= $club->c_name ?></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"
                        style="font-family: sans-serif;
                        font-size: 1rem;
                        font-weight: bold;">
                    Members
                </li>
            </ol>
        </nav>
        <br>
        <nav>
            <div class="nav nav-pills" id="nav-tab" role="tablist">
                <button class="nav-link active tab_link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
                    role="tab" aria-controls="nav-home" aria-selected="true"><span><i class="fa-solid fa-users-gear"></i></span> Manage Members</button>
                <button class="nav-link tab_link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><span><i class="fa-solid fa-user-shield"></i></span> Membership Request</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                <h3 class="text-center mt-5">Manage Members</h3>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Role</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($members as $mem)
                                <tr>
                                    <td><?= $mem->ui_first_name.' '.$mem->ui_middle_name[0].'. '.$mem->ui_last_name ?></td>
                                    <td><?= $mem->ui_address ?> </td>
                                    <td><?= $mem->email ?></td>
                                    <td><?= $mem->ui_mobile ?></td>
                                    <td><?= $mem->mt_type ?></td>
                                    <td class="text-center">
                                        <a href="{{route('member_setting',['cmid'=>$mem->cm_id])}}" class="btn btn-primary"><i class="fa-solid fa-gear"></i></a>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#removeMember<?=$mem->cm_id?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="removeMember<?=$mem->cm_id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Remove Member</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>You are about to remove <?= $mem->ui_first_name.' '.$mem->ui_middle_name[0].'. '.$mem->ui_last_name ?> in your club. Do you want to continue? </h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <a href="{{route('remove_member',['cmid'=>$mem->cm_id, 'cid'=>$mem->cm_c_id])}}"class="btn btn-primary">Continue</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

{{-- ========================================================================================================================================= --}}


            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                <h3 class="text-center mt-5">Membership Request</h3>
                <br>
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            @if (!$memRequest->isEmpty())
                                @foreach ($memRequest as $req)
                                    <td><?= $req->ui_first_name.' '.$req->ui_middle_name[0].'. '.$req->ui_last_name ?></td>
                                    <td><?= $req->ui_address ?> </td>
                                    <td><?= $req->email ?></td>
                                    <td><?= $req->ui_mobile ?></td>
                                    <td>
                                        <a href="{{route('reject_member',['mrid'=>$req->mr_id, 'cid'=>$req->mr_c_id])}}" class="btn btn-danger">Reject</a>
                                        <a href="{{route('accept_member',['mrid'=>$req->mr_id, 'cid'=>$req->mr_c_id, 'uid'=>$req->mr_u_id])}}" class="btn btn-primary">Accept</a>
                                    </td>
                                @endforeach
                            @else
                                <td colspan="5" class="text-center">No membership request found!</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
