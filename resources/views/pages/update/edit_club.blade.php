@extends('layouts.home_layout')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-6 col-lg-6 m-auto">
                <form action="{{route('update_club', ['id'=>$clubInfo[0]->c_id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card shadow">
                        <div class="card-header card_header_bg">
                            <h2 class="text-center card_header_font">Update Club Information</h2>
                        </div>
                        <div class="card-body p-md-5">
                            <div class="row">
                                @if (session()->has('message_error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?php echo session()->get('message_error'); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <?php session()->forget('message_error'); ?>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                                    <label for="clubLogo" class="form-label"><b>Club Logo</b></label>
                                    <img src="{{asset('img/'.$clubInfo[0]->c_logo)}}" alt="" id="previewImage" class="img_preview mb-2 form-control">
                                    <input type="file" name="clubLogo" id="clubLogo" class="form-control">
                                    <input type="text" class="form-control" id="origLogo" name="origLogo" value="<?= $clubInfo[0]->c_logo ?>" hidden>
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
                                <div class="mb-3">
                                    <label for="clubName" class="form-label"><b>Club Name</b></label>
                                    <input type="text" class="form-control" id="clubName" name="clubName" placeholder="Input club name" value="<?= $clubInfo[0]->c_name ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="clubAddress" class="form-label"><b>Club Address</b></label>
                                    <input type="text" class="form-control" id="clubAddress" name="clubAddress" placeholder="Input club address" value="<?= $clubInfo[0]->c_address ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="clubEmail" class="form-label"><b>Club Email</b></label>
                                    <input type="text" class="form-control" id="clubEmail" name="clubEmail" placeholder="Input club email" value="<?= $clubInfo[0]->c_email ?>" required>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="clubMobile" class="form-label"><b>Club Mobile</b></label>
                                        <input type="text" class="form-control" id="clubMobile" name="clubMobile" placeholder="Input club mobile" value="<?= $clubInfo[0]->c_mobile ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="clubFounded" class="form-label"><b>Club Date Founded</b></label>
                                        <input type="date" class="form-control" id="clubFounded" name="clubFounded" value="<?= $clubInfo[0]->c_date_founded ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="facebook" class="form-label"><b>Facebook</b></label>
                                    <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Input Facebook link..." value="<?= $clubInfo[0]->c_facebook ?>" >
                                </div>
                                <div class="mb-3">
                                    <label for="instagram" class="form-label"><b>Instagram</b></label>
                                    <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Input Instagram link..." value="<?= $clubInfo[0]->c_instagram ?>" >
                                </div>
                                <div class="mb-3">
                                    <label for="x" class="form-label"><b>X</b></label>
                                    <input type="text" class="form-control" id="x" name="x" placeholder="Input X link..." value="<?= $clubInfo[0]->c_x ?>" >
                                </div>
                                <div class="mb-3">
                                    <label for="youtube" class="form-label"><b>YouTube</b></label>
                                    <input type="text" class="form-control" id="youtube" name="youtube" placeholder="Input Youtube link..." value="<?= $clubInfo[0]->c_youtube ?>" >
                                </div>
                                <div class="mb-3">
                                    <label for="web" class="form-label"><b>Website</b></label>
                                    <input type="text" class="form-control" id="web" name="web" placeholder="Input website link..." value="<?= $clubInfo[0]->c_website ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-end m-1">Save Changes</button>
                            <a href="{{route('view_club',['id'=>$clubInfo[0]->c_id])}}" class="btn btn-danger float-end m-1">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>


@endsection
