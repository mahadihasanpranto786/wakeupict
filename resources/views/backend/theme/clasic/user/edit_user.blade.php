@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Edit User
@endsection
{{-- menu active start --}}
@section('user_active', 'menu-open')

@section('menu_active_user', 'active')

@section('user_list_list', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">

        <div class="col-md-4">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        @if ($user->photo == null)
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ URL::asset('uploads/profile/demo.jpg') }}" alt="User profile picture">
                        @else
                            <img type="button" data-toggle="modal" data-target="#userPhoto{{ $user->id }}"
                                class="profile-user-img img-fluid img-circle" src="{{ URL::asset($user->photo) }}"
                                alt="User profile picture">
                        @endif
                    </div>

                    <h3 class="profile-username text-center">{{ $user->name }}</h3>

                    <p class="text-muted text-center">{{ $user->type }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <form class="form-horizontal" action="{{ URL::to('change-user-password') }}"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="form-group">
                                <label for="old_password">Change Password</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="old_password" id="old_password"
                                        placeholder="Enter Old Password">
                                    @error('old_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <span id="password_alert" class="text-danger mb-1"></span>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="password" id="password"
                                        placeholder="Enter New Password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <span id="password_alert2" class="text-danger mb-1"></span>
                                <div class="pt-2">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        Confirm</button>
                                </div>
                            </div>
                        </form>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>

        </div>

        <div class="col-md-8">
            <div class="card">
                <form action="{{ route('edit-user') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" data-validation='required'
                                        class="form-control" placeholder="Enter User Name" value="{{ $user->name }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" data-validation='required'
                                        class="form-control" placeholder="Enter User Email" value="{{ $user->email }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Type</label>
                                    <select name="type" data-validation='required' class="form-control select2"
                                        style="width: 100%;">
                                        <option label="Choose Type" selected disabled>Select One</option>
                                        <option value="Admin" {{ 'Admin' == $user->type ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="Moderator" {{ 'Moderator' == $user->type ? 'selected' : '' }}>
                                            Moderator
                                        </option>
                                        <option value="Employee" {{ 'Employee' == $user->type ? 'selected' : '' }}>
                                            Employee
                                        </option>
                                    </select>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Employee Type</label>
                                    <select name="employee_type" data-validation='required' class="form-control select2"
                                        style="width: 100%;">
                                        <option label="Choose Type" selected disabled>Select One</option>
                                        <option value="Paid" {{ 'Paid' == $user->employee_type ? 'selected' : '' }}>Paid
                                        </option>
                                        <option value="Unpaid" {{ 'Unpaid' == $user->employee_type ? 'selected' : '' }}>
                                            Unpaid
                                        </option>
                                    </select>
                                    @error('employee_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nid_number">NID Number</label>
                                    <input type="number" name="nid_number" id="nid_number" data-validation='required'
                                        class="form-control" placeholder="Enter User NID Number"
                                        value="{{ $user->nid_number }}">
                                    @error('nid_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo">Profile Photo (Optional)</label>
                                    <input type="file" name="photo" id="photo" class="form-control"
                                        placeholder="Enter User NID Number" value="{{ $user->photo }}">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Designation</label>
                                    <select name="designation_id" data-validation='required' class="form-control select2"
                                        style="width: 100%;">
                                        <option label="Choose" selected disabled>Select One</option>
                                        @foreach ($designations as $designation)
                                            <option value="{{ $designation->id }}"
                                                {{ $designation->id == $user->designation_id ? 'selected' : '' }}>
                                                {{ $designation->designation_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('designation_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Excess</label>
                                    <select id="incomeType" name="excess_type" data-validation='required'
                                        class="form-control select2" style="width: 100%;">
                                        <option label="Choose User Excess" selected disabled>Select One</option>
                                        <option value="1" {{ '1' == $user->excess_type ? 'selected' : '' }}>Local
                                        </option>
                                        <option value="2" {{ '2' == $user->excess_type ? 'selected' : '' }}>Global
                                        </option>
                                        <option value="3" {{ '3' == $user->excess_type ? 'selected' : '' }}>All
                                        </option>
                                    </select>
                                    @error('excess_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="old_photo" value="{{ $user->photo }}">
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="btn btn-block btn-primary">
                                Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="userPhoto{{ $user->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">

                        <img class="card-img-top" src="{{ URL::asset($user->photo) }}"
                            alt="{{ $user->name }}'s Photo">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @include('backend/theme/clasic/include/modal_photos/modal')
    </div>
    <!-- jQuery -->
    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#old_password').keyup(function() {
                value = $(this).val();
                if (value.length < 8) {
                    $('#password_alert').html('Please Enter Minimum 8 Digit!');
                } else if (value.length >= 8) {
                    $('#password_alert').empty();

                };
            })


            $('#password').keyup(function() {
                value = $(this).val();
                if (value.length < 8) {
                    $('#password_alert2').html('Please Enter Minimum 8 Digit!');
                } else if (value.length >= 8) {
                    $('#password_alert2').empty();

                };
            })
        })
    </script>
@endsection
