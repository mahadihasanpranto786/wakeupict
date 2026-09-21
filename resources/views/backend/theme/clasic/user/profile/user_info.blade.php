@extends('backend.theme.clasic.user.profile.profile')
@section('profileContent')
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <span>
                    <h3>{{ Auth::user()->name }} <sub><i class="text-dark">({{ Auth::user()->type }})</i></sub></h3>

                </span>
                <div class="row">
                    <div class="col-md-12">
                        <i>
                            <h3><span>Email </span>: {{ Auth::user()->email }}</h3>
                        </i>
                    </div>
                    <div class="col-md-12">
                        <i>
                            <h3><span>NID Number </span>: {{ Auth::user()->nid_number }}</h3>
                        </i>
                    </div>
                    <div class="col-md-12">
                        <i>
                            <h3><span>Employee Type </span>: {{ Auth::user()->employee_type }}</h3>
                        </i>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
    @endsection
