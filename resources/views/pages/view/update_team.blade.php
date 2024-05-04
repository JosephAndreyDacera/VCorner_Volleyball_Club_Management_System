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
            <div class="col-md-6 col-lg-6 col-sm-12 p-3">
                <form action="{{route('update_team',['cid'=>$club->c_id,'tid'=>$team->t_id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <h3 class="text-center"><?= $team->t_name ?></h3>
                        <hr>
                        <div class="col-md-6 col-lg-6 col-sm-12 mb-3 m-auto">
                            <label for="teamLogo" class="form-label"><b>Team Logo</b></label>
                            <img src="{{asset('img/'.$team->t_logo)}}" alt="" id="previewImage" class="img_preview mb-2 form-control m-auto">
                            <input type="file" name="teamLogo" id="teamLogo" class="form-control">
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
                            <input type="text" class="form-control" id="teamName" name="teamName" placeholder="Input team name..." value="<?= $team->t_name ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="teamDescription" class="form-label"><b>Team Description</b></label>
                            <input type="text" class="form-control" id="teamDescription" name="teamDescription" placeholder="Input team description..." value="<?= $team->t_description ?>" required>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary float-end me-3"> Save Changes </button>
                            <a href="{{route('removeTeam',['tid'=>$team->t_id, 'cid'=>$club->c_id])}}" class="btn btn-danger float-end me-3"> Remove Team</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 p-3">
                <h3 class="text-center">Team Members</h3>
                <br>
                @foreach ($teamMembers as $member)
                    <h5 class="text-center"><?= $member->ui_first_name.' '.$member->ui_middle_name[0].'. '.$member->ui_last_name ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?=$member->tmr_role?></h5>
                @endforeach
            </div>
        </div>
    </div>
@endsection
