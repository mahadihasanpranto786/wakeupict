@extends('backend.theme.clasic.user.profile.profile')
@section('profileContent')
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <form class="form-horizontal" action="{{ URL::to('change-password') }}" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="old_password" class="col-sm-2 col-form-label">Change Password</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="old_password" id="old_password"
                                placeholder="Enter Old Password">
                            @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="password" id="password"
                                placeholder="Enter New Password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-block btn-danger">Confirm</button>
                        </div>
                    </div>
                </form>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    <!-- /.nav-tabs-custom -->
@endsection
