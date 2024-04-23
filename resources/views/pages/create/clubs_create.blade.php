@extends('layouts.home_layout')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-6 col-lg-6 m-auto">
                <form action="{{route('store_club')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card shadow">
                        <div class="card-header card_header_bg">
                            <h2 class="text-center card_header_font">Create New Club</h2>
                        </div>
                        <div class="card-body p-md-5">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="clubName" class="form-label"><b>Club Name</b></label>
                                    <input type="text" class="form-control" id="clubName" name="clubName" placeholder="Input club name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="clubAddress" class="form-label"><b>Club Address</b></label>
                                    <input type="text" class="form-control" id="clubAddress" name="clubAddress" placeholder="Input club address" required>
                                </div>
                                <div class="mb-3">
                                    <label for="clubEmail" class="form-label"><b>Club Email</b></label>
                                    <input type="text" class="form-control" id="clubEmail" name="clubEmail" placeholder="Input club email" required>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="clubMobile" class="form-label"><b>Club Mobile</b></label>
                                        <input type="text" class="form-control" id="clubMobile" name="clubMobile" placeholder="Input club mobile" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="clubFounded" class="form-label"><b>Club Date Founded</b></label>
                                        <input type="date" class="form-control" id="clubFounded" name="clubFounded" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <label for="clubLogo" class="form-label"><b>Club Logo</b></label>
                                    <img src="{{asset('img/club_logo/club1.png')}}" alt="" id="previewImage" class="img_preview mb-2 form-control">
                                    <input type="file" name="clubLogo" id="clubLogo" class="form-control">
                                </div>
                                <script>
                                    const imageInput = document.getElementById('clubLogo');
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
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-end m-1">Submit</button>
                            <a href="{{route('clubs')}}" class="btn btn-danger float-end m-1">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>


@endsection
