@extends('layouts.home_layout')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb mb-3">
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
                    Membership Request Updates
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h3 class="mt-5 text-center">Membership Request Updates</h3>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <table class="table mt-5">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Name</th>
                            <th scope="col" class="text-center">Email</th>
                            <th scope="col" class="text-center">Mobile</th>
                            <th scope="col" class="text-center">Invite Code</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!$memberRequest->isEmpty())
                            @foreach ($memberRequest as $memReq)
                                <tr>
                                    <td class="text-center"><?= $memReq->c_name ?></td>
                                    <td class="text-center"><?= $memReq->c_email ?></td>
                                    <td class="text-center"><?= $memReq->c_mobile ?></td>
                                    <td class="text-center"><?= $memReq->c_invite_code ?></td>
                                    <td class="text-center">
                                        <a href="{{route('cancel_membership_request',['cid'=>$memReq->mr_c_id,'uid'=>$memReq->mr_u_id])}}" class="btn btn-danger">
                                            <span><i class="fa-solid fa-xmark me-1"></i></span>
                                            Cancel Request
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                                <tr>
                                    <td class="text-center" colspan="5"><i>No pending membership requests!</i></td>
                                </tr>

                        @endif
                                <tr>
                                    <td colspan="5">
                                        <a href="{{route('clubs')}}" class="btn btn-primary float-end">
                                            <span><i class="fa-regular fa-circle-left"></i></span> Go Back
                                        </a>
                                    </td>
                                </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
