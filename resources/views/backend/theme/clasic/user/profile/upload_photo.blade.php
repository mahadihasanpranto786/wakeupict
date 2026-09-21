@extends('backend.theme.clasic.user.profile.profile')
@section('profileContent')
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <form class="form-horizontal" action="{{ URL::to('upload-your-photo') }}" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="photo" class="col-sm-2 col-form-label">Upload Photo</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="photo" id="photo" placeholder="photo">

                            @error('photo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" name="old_photo" value="{{ $userinfo->photo }}">
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">Upload</button>
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
