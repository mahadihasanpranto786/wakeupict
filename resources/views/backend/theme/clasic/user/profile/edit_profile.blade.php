@extends('backend.theme.clasic.user.profile.profile')
@section('profileContent')
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <form class="form-horizontal" action="{{ URL::to('edit-your-profile') }}" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="name">Your Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name"
                                value="{{ Auth::user()->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="email">Your Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter Your email"
                                value="{{ Auth::user()->email }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-4">
                            <label for="nid_number">Your NID No:</label>
                            <input type="text" class="form-control" name="nid_number" id="nid_number"
                                placeholder="Enter Your NID No:" value="{{ Auth::user()->nid_number }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div style="margin-top: 32px;">
                        <button type="submit" class="btn btn-block btn-danger">Confirm</button>
                    </div>
                </form>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    <!-- /.nav-tabs-custom -->
@endsection
