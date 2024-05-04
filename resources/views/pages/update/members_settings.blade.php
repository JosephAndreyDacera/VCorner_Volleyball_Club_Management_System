@extends('layouts.home_layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-8 col-sm-12 m-auto">
                <form action="" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header p-4">
                            <h3><i class="fa-solid fa-gear"></i> Settings</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <h5>Access Permissions</h5>
                                <hr>
                                <div class="p-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                        <label class="form-check-label ms-2" for="flexSwitchCheckDefault"><b>Manage Members</b></label>
                                        <p class="form-text ms-2">Manage membership request, update roles and access permisions.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                        <label class="form-check-label ms-2" for="flexSwitchCheckDefault"><b>Manage Teams</b></label>
                                        <p class="form-text ms-2">Create and remove teams, assign members to each teams, assign roles to team members.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                        <label class="form-check-label ms-2" for="flexSwitchCheckDefault"><b>Manage Members</b></label>
                                        <p class="form-text ms-2">Manage membership request, update roles and access permisions.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
