@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Leave Category With Days
@endsection
{{-- menu active start --}}
@section('leave_active', 'menu-open')

@section('leave_menu_active', 'active')

@section('employee_leave_list', 'active')
{{-- menu active end --}}

@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Leave Category With Days
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-10 offset-1">
                            <div class="modal-body">
                                <div class="card Alerthere">
                                    <!-- form start -->
                                    <form action="{{ route('leave_application_store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="leave_category_id">Leave Category</label>
                                                        <select name="leave_category_id[]" id="leave_category_id"
                                                            data-validation='required'
                                                            class="form-control leave_category_id select2">
                                                            <option label="Choose title" selected disabled>Select
                                                                One
                                                            </option>
                                                            @foreach ($leaveCategories as $category)
                                                                <option value="{{ $category->id }}">
                                                                    {{ $category->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger DaysHave"></span>
                                                        @error('leave_category_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone">Phone</label>
                                                        <input type="number" name="phone" id="phone"
                                                            data-validation='required' class="form-control"
                                                            placeholder="Enter Phone Number">
                                                        @error('phone')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row moreDateAdd">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="start_date">Start Date</label>
                                                        <input type="text" name="start_date" id="start_date"
                                                            data-validation='required' class="form-control datepicker"
                                                            placeholder="Enter Start Date">
                                                        @error('start_date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="end_date">End Date</label>
                                                        <input type="text" name="end_date" id="end_date"
                                                            data-validation='required' class="form-control datepicker"
                                                            placeholder="Enter End Date">
                                                        @error('end_date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="leave_taken">Leaves Days</label>
                                                        <input type="number" name="leave_taken[]" id="leave_taken"
                                                            data-validation='required' class="form-control leave_taken"
                                                            placeholder="Enter Leaves Days">
                                                        @error('leaveDays')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="button" class="btn btn-sm btn-primary addMoreLeave">
                                                    Add More Leave</button>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label for="application">Application</label>
                                                <textarea type="number" name="application" id="application"
                                                    data-validation='required' class="form-control textarea"
                                                    placeholder="Write Your Application"></textarea>
                                                @error('application')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div> --}}
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-block btn-primary">
                                                    Apply</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".addMoreLeave").click(function() {
                let moreDateAdd = `<div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="start_date">Start Date</label>
                                                        <input type="text" name="start_date" id="start_date"
                                                            data-validation='required' class="form-control datepicker"
                                                            placeholder="Enter Start Date">
                                                        @error('start_date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="end_date">End Date</label>
                                                        <input type="text" name="end_date" id="end_date"
                                                            data-validation='required' class="form-control datepicker"
                                                            placeholder="Enter End Date">
                                                        @error('end_date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="leave_taken">Leaves Days</label>
                                                        <input type="number" name="leave_taken[]" id="leave_taken"
                                                            data-validation='required' class="form-control leave_taken"
                                                            placeholder="Enter Leaves Days">
                                                        @error('leaveDays')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-1 mt-4">
                                                    <div class="form-group"  style='margin-top: 10px;'>
                                                        <button type="button" class="btn btn-sm btn-danger removeMoreDates">
                                                            <i class='fas fa-minus'></i></button>
                                                    </div>
                                               </div>
                                                `;

                $(".moreDateAdd").append(moreDateAdd)
                $(".removeMoreDates").click(function() {
                    $(this).parents('.moreDateAdd').remove();
                })

                $(".leave_category_id2").change(function() {
                    leaveCat = $(this).val();
                    CatchLeaveCat(leaveCat)
                })
            });

            $(".leave_category_id").change(function() {
                leaveCat = $(this).val();
                $.ajax({
                    method: 'POST',
                    type: 'json',
                    data: {
                        leaveCat: leaveCat
                    },
                    url: "{{ route('leaveCategoryAjax') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $(this).parentsUntil().find(".DaysHave").text("You Have " + data +
                            ' Day For Leave!')
                        console.log(data);
                    },
                    error: function(error) {

                    }

                })
            })

            function CatchLeaveCat(leaveCat) {
                $.ajax({
                    method: 'POST',
                    type: 'json',
                    data: {
                        leaveCat: leaveCat
                    },
                    url: "{{ route('leaveCategoryAjax') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $(this).after(".DaysHave").text("You Have " + data + ' Day For Leave!')
                        console.log(data);
                    },
                    error: function(error) {

                    }

                })
            }

        });
    </script>
    <script>
        $(document).ready(function() {
            $('.toast').toast(option)
        });
    </script>
@endsection
