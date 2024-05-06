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
                <li class="breadcrumb-item"><a href="{{route('view_club',['cid'=>$cid])}}"
                        style="font-family: sans-serif;
                        font-size: 1rem;
                        font-weight: bold;">
                    <?= $club->c_name?></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"
                        style="font-family: sans-serif;
                        font-size: 1rem;
                        font-weight: bold;">
                    Tournaments
                </li>
            </ol>
        </nav>
        <br>
        <div class="row">
            <div class="col-md-8 col-lg-8 col-sm-8">
                <h3><i class="fa-solid fa-trophy"></i> Tournaments</h3>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4">
                <button  type="button" data-bs-toggle="modal" data-bs-target="#newTournamentModal" class="btn btn-primary float-end"><i class="fa-solid fa-circle-plus me-2"></i> Add New Tournament </button>
            </div>
            <div class="modal fade" id="newTournamentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form action="{{route('add_tournament',['cid'=>$cid])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Tournament</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-12 mb-3    ">
                                        <label for="tourLogo" class="form-label"><b>Tornament Logo</b></label>
                                        <img src="{{asset('img/club_logo/club1.png')}}" alt="" id="previewImage" class="img_preview mb-2 form-control">
                                        <input type="file" name="tourLogo" id="tourLogo" class="form-control" required>
                                    </div>
                                    <script>
                                        var imageInput = document.getElementById('tourLogo');
                                        var previewImage = document.getElementById('previewImage');
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
                                        <label for="tourName" class="form-label"><b>Tournament Name</b></label>
                                        <input type="text" class="form-control" id="tourName" name="tourName" placeholder="Input tournament name..." required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="tourDescription" class="form-label"><b>Tournament Description</b></label>
                                        <input type="text" class="form-control" id="tourDescription" name="tourDescription" placeholder="Input tournament description..." required>
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

            {{-- Desplay Tournaments Here --}}
            <div class="row">
                {{-- Code Here --}}
                @foreach ($tournaments as $tour)
                    <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12 d-flex align-items-stretch mb-3">
                        <div class="card ms-auto me-auto w-100 club_card">
                            <div class="m-auto w-auto">
                                <img src="{{asset('img/'.$tour->tour_logo)}}" class="card-img-top card_image" alt="Card Image">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5><?= $tour->tour_name ?></h5>
                                <h6><?= $tour->tour_description ?> </h6>
                            </div>
                            <div class="card-footer">
                                <div>
                                    @if ($tour->tour_status==0)
                                        <a href="{{route('view_tournament',[$tour->tour_id])}}" class="btn btn-primary float-end"><i class="fa-solid fa-eye"></i></a>
                                        <button class="btn btn-success float-end me-2"   type="button" data-bs-toggle="modal" data-bs-target="#tourEdit<?=$tour->tour_id?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                    @else
                                        <h6 class="text-secondary"><i class="fa-solid fa-trophy"></i> Concluded <span><a href="{{route('view_tournament',[$tour->tour_id])}}" class="btn btn-primary float-end"><i class="fa-solid fa-eye"></i></a></span></h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="tourEdit<?=$tour->tour_id?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form action="{{route('update_tournament',['cid'=>$cid,'tour'=>$tour->tour_id])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Tournament</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-sm-12 mb-3    ">
                                                <label for="editTourLogo" class="form-label"><b>Tornament Logo</b></label>
                                                <img src="{{asset('img/'.$tour->tour_logo)}}" alt="" id="prevImage" class="img_preview mb-2 form-control">
                                                <input type="file" name="editTourLogo" id="editTourLogo" class="form-control">
                                            </div>
                                            <script>
                                                imageInput = document.getElementById('editTourLogo');
                                                previewImage = document.getElementById('prevImage');
                                                function prevSelectedImage() {
                                                    const file = imageInput.files[0];
                                                    if (file) {
                                                        const reader = new FileReader();
                                                        reader.readAsDataURL(file);
                                                        reader.onload = function(e) {
                                                            previewImage.src = e.target.result;
                                                        }
                                                    }
                                                }
                                                imageInput.addEventListener('change', prevSelectedImage);
                                            </script>

                                            <div class="mb-3">
                                                <label for="tourName" class="form-label"><b>Tournament Name</b></label>
                                                <input type="text" class="form-control" id="editTourName" name="editTourName" placeholder="Input tournament name..." value="<?= $tour->tour_name ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tourDescription" class="form-label"><b>Tournament Description</b></label>
                                                <input type="text" class="form-control" id="editTourDescription" name="editTourDescription" placeholder="Input tournament description..." value="<?= $tour->tour_description ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                                        @if ($tour->tour_status==0)
                                            <a href="{{route('remove_tournament',['tour'=>$tour->tour_id, 'cid'=>$cid])}}" class="btn btn-danger">Remove</a>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
