@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    {{ Auth::user()->name }}'s Profile
@endsection

@section('maincontant')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if (Auth::user()->photo == null)
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ URL::asset('uploads/profile/demo.jpg') }}" alt="User profile picture">
                            @else
                                <img type="button" data-toggle="modal" data-target="#userPhoto"
                                    class="profile-user-img img-fluid img-circle"
                                    src="{{ URL::asset(Auth::user()->photo) }}" alt="User profile picture">

                            @endif
                        </div>

                        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                        <p class="text-muted text-center">{{ Auth::user()->type }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <a href="{{ route('upload-user-image') }}" class="btn btn-primary btn-block"><b>Upload
                                        Image</b></a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('change-password') }}" class="btn btn-primary btn-block"><b>Change
                                        Password</b></a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('edit-your-profile') }}" class="btn btn-primary btn-block"><b>Edit
                                        Profile</b></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <a class="text-white font-weight-bold btn btn-outline-success" href="{{ route('profile') }}">My
                            Profile</a>

                    </ul>
                </div><!-- /.card-header -->
                @yield('profileContent')
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

    <!-- Modal -->
    <div class="modal fade" id="userPhoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <img class="card-img-top" src="{{ URL::asset(Auth::user()->photo) }}"
                        alt="{{ Auth::user()->name }}'s Photo">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
