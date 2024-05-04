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
                    Teams
                </li>
            </ol>
        </nav>
        <br>
        <div class="row mt-3">
            {{-- <h2 class="text-center"><?= $club->c_name ?></h2> --}}
            <div class="row mt-3">
                <div class="col-md-8 col-lg-8 col-sm-8">
                    <h3><i class="fa-solid fa-users-rectangle"></i> Teams</h3>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-4">
                    <button  type="button" data-bs-toggle="modal" data-bs-target="#newTeamModal" class="btn btn-primary float-end"><i class="fa-solid fa-circle-plus me-2"></i> Add New Team </button>
                </div>
                <div class="modal fade" id="newTeamModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form action="{{route('add_team',['cid'=>$club->c_id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Team</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-12 mb-3    ">
                                            <label for="teamLogo" class="form-label"><b>Team Logo</b></label>
                                            <img src="{{asset('img/club_logo/club1.png')}}" alt="" id="previewImage" class="img_preview mb-2 form-control">
                                            <input type="file" name="teamLogo" id="teamLogo" class="form-control" required>
                                        </div>
                                        <script>
                                            const imageInput = document.getElementById('teamLogo');
                                            const previewImage = document.getElementById('previewImage');
                                            function previewSelectedImage() {
                                                const file = imageInput.files[0];
                                                if (file) {
                                                    const reader = new FileReader();
                                                    reader.readAsDataURL(file);
                                                    reader.onload = function(e) {
                                                    previewImage.src = e.target.result;
                                                    }
                                                }
                                            }
                                            imageInput.addEventListener('change', previewSelectedImage);
                                        </script>

                                        <div class="mb-3">
                                            <label for="teamName" class="form-label"><b>Team Name</b></label>
                                            <input type="text" class="form-control" id="teamName" name="teamName" placeholder="Input team name..." required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="teamDescription" class="form-label"><b>Team Description</b></label>
                                            <input type="text" class="form-control" id="teamDescription" name="teamDescription" placeholder="Input team description..." required>
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
                <hr class="mt-3">
                <nav class="mb-3">
                    <div class="nav nav-pills" id="nav-tab" role="tablist">
                        <button class="nav-link active tab_link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
                            role="tab" aria-controls="nav-home" aria-selected="true"><span><i class="fa-solid fa-users-gear"></i></span> Teams</button>
                        <button class="nav-link tab_link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><span><i class="fa-solid fa-user-plus"></i></span> Assign Members</button>
                            <button class="nav-link tab_link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-update"
                                type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><span><i class="fa-solid fa-user-plus"></i></span> Update Members</button>
                    </div>
                </nav>
                <br>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                        <div class="row mt-3">
                            @foreach ($teams as $team)
                                <div class="col-md-3 col-sm-6 col-xs-12 d-flex align-items-stretch mb-3">
                                    <a href="{{route('view_update_team',['tid'=>$team->t_id])}}" class="text-black text-decoration-none">
                                        <div class="card ms-auto me-auto w-100 club_card">
                                            <div class="m-auto w-auto">
                                                <img src="{{asset('img/'.$team->t_logo)}}" class="card-img-top card_image" alt="Card Image">
                                            </div>
                                            <div class="card-body d-flex flex-column">
                                                <h5><?= $team->t_name ?></h5>
                                                <h6><?= $team->t_description ?> </h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

        {{-- ========================================================================================================================================= --}}


                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                        <h3 class="text-center">Assign Members to Teams</h3>
                        <br>
                        <div class="row">
                            <div class="col-md-7 col-lg-7 col-sm-12 m-auto">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">Member Name</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($noTeam as $member)
                                            <tr>
                                                <td><h5><?= $member->ui_first_name.' '.$member->ui_middle_name[0].'. '.$member->ui_last_name ?></h5></td>
                                                <td class="text-center">
                                                    <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#assignModal<?=$member->id?>"><i class="fa-solid fa-edit"></i> Assign</button>
                                                </td>
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="assignModal<?=$member->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{route('assign_team',['cmid'=>$member->cm_id,'cid'=>$club->c_id])}}" method="post">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Assign Member to a Team</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="assignTeam" class="form-label">Team</label>
                                                                    <select class="form-select" id="assignTeam" name="assignTeam">
                                                                        @foreach ($teams as $team)
                                                                            <option value="<?=$team->t_id?>"><?=$team->t_name ?></option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="assignRole" class="form-label">Role</label>
                                                                    <select class="form-select" id="assignRole" name="assignRole">
                                                                        @foreach ($teamMemberRole as $role)
                                                                            <option value="<?=$role->tmr_id?>"><?=$role->tmr_role ?></option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-update" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">

                        <h3 class="text-center">Team Members</h3>
                        <br>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Member Name</th>
                                    <th scope="col">Team Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col"  class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($withTeam as $member)
                                    <tr>
                                        <td><h5><?= $member->ui_first_name.' '.$member->ui_middle_name[0].'. '.$member->ui_last_name ?></h5></td>
                                        <td><h5><?= $member->t_name ?></h5></td>
                                        <td><h5><?= $member->tmr_role ?></h5></td>
                                        <td class="text-center">
                                            <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-edit"></i> Update</button>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('assign_team',['cmid'=>$member->cm_id,'cid'=>$club->c_id])}}" method="post">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="assignTeam" class="form-label">Team</label>
                                                            <select class="form-select" id="assignTeam" name="assignTeam">
                                                                @foreach ($teams as $team)
                                                                    @if ($team->t_id == $member->cm_t_id)
                                                                        <option value="<?=$team->t_id?>" selected><?=$team->t_name ?></option>
                                                                    @else
                                                                        <option value="<?=$team->t_id?>"><?=$team->t_name ?></option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="assignRole" class="form-label">Role</label>
                                                            <select class="form-select" id="assignRole" name="assignRole">
                                                                @foreach ($teamMemberRole as $role)
                                                                    @if ($role->tmr_id == $member->cm_tmr_id)
                                                                        <option value="<?=$role->tmr_id?>" selected><?=$role->tmr_role ?></option>
                                                                    @else
                                                                        <option value="<?=$role->tmr_id?>"><?=$role->tmr_role ?></option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                                                        <a href="{{route('removeFromTeam',['cmid'=>$member->cm_id,'cid'=>$club->c_id])}}" class="btn btn-danger">Remove</a>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
