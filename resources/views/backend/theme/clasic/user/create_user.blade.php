@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Create User or Employee
@endsection
{{-- menu active start --}}
@section('user_active', 'menu-open')

@section('menu_active_user', 'active')

@section('user_list_list', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="card">
            <div class="card-header">
                Create User or Employee
            </div>
            <form action="{{ route('store-user') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" data-validation='required'
                                        class="form-control" placeholder="Enter User Name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" data-validation='required'
                                        class="form-control" placeholder="Enter User Email" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nid_number">NID Number</label>
                                    <input type="number" name="nid_number" id="nid_number" data-validation='required'
                                        class="form-control" placeholder="Enter User NID Number"
                                        value="{{ old('nid_number') }}">
                                    @error('nid_number')
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
                                        <option value="Admin">Admin</option>
                                        <option value="Moderator">Moderator</option>
                                        <option value="Employee">Employee</option>
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
                                        <option label="Choose" selected disabled>Select One</option>
                                        <option value="Paid">Paid</option>
                                        <option value="Unpaid">Unpaid</option>
                                    </select>
                                    @error('employee_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Excess</label>
                                    <select name="excess_type" data-validation='required' class="form-control select2"
                                        style="width: 100%;">
                                        <option label="Choose User Excess" selected disabled>Select One</option>
                                        <option value="1">Local</option>
                                        <option value="2">Global</option>
                                        <option value="3">All</option>
                                    </select>
                                    @error('excess_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo">Profile Photo (Optional)</label>
                                    <input type="file" name="photo" id="photo" class="form-control"
                                        placeholder="Enter User NID Number" value="{{ old('photo') }}">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Designation</label>
                                    <select name="designation_id" data-validation='required' class="form-control select2"
                                        style="width: 100%;">
                                        <option label="Choose" selected disabled>Select One</option>
                                        @foreach ($designations as $designation)
                                            <option value="{{ $designation->id }}">
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
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" data-validation='required'
                                        class="form-control" placeholder="Enter User Password"
                                        value="{{ old('password') }}">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <span id="password_alert" class="text-danger mb-1"></span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        data-validation='required' class="form-control"
                                        placeholder="Enter Confirmation Password"
                                        value="{{ old('password_confirmation') }}">
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="pt-2">
                            <button type="submit" class="btn btn-block btn-primary">
                                Register</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        @include('backend/theme/clasic/include/modal_photos/modal')
    </div>

    <!-- jQuery -->
    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#password').keyup(function() {

                value = $(this).val();
                if (value.length < 8) {
                    $('#password_alert').html('Please Enter Minimum 8 Digit!');
                } else if (value.length >= 8) {
                    $('#password_alert').empty();

                };
            })
        })
    </script>


@endsection
