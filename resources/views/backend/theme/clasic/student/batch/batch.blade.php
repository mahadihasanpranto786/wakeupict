@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Student Batch Number
@endsection
{{-- menu active start --}}
@section('student_active', 'menu-open')

@section('menu_active_active', 'active')

@section('batch_list_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Student Batch Number
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 2%">SL</th>
                                <th style="width: 5%">Batch Number</th>
                                <th style="width: 20%">Course</th>
                                <th style="width: 3%">Type</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $serial = 1;
                            @endphp
                            @foreach ($batches as $batch)
                                <tr>
                                    <td style="width: 10%"> {{ $serial++ }}</td>
                                    <td style="width: 20%">{{ $batch->batch_number }}
                                    </td>
                                    <td style="width: 30%">{{ $batch->course->course_title }}
                                    </td>
                                    <td style="width: 30%">{{ $batch->category->title }}
                                    </td>
                                    <td style="width: 10%">
                                        @if ($batch->active_batch == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="border" style="width: 30%">
                                        {{-- status --}}
                                        @if (checkUserType() == 0)
                                            @if ($batch->active_batch == 1)
                                                <button title="Inactive" class="btn btn-danger btn-sm"> <a
                                                        class="flex items-center "
                                                        href="{{ url('batch-inactive/' . $batch->id) }}"> <i
                                                            class="fas fa-arrow-circle-down text-white"></i></a>
                                                </button>
                                            @else
                                                <button title="Active" class="btn btn-success btn-sm"> <a
                                                        class="flex items-center "
                                                        href="{{ url('batch-active/' . $batch->id) }}"> <i
                                                            class="fas fa-arrow-circle-up text-white"></i></a>
                                                </button>
                                            @endif
                                            {{-- edit --}}
                                            <button title="Edit" data-toggle="modal" data-target="#editBatchModal"
                                                class="btn btn-primary btn-sm flex items-center">
                                                <i class="fas fa-pencil-alt text-white"></i>

                                            </button>
                                        @endif
                                        {{-- delete --}}
                                        {{-- <button title="Delete" class="btn btn-danger btn-sm"><a class="flex items-center "
                                                id="delete" href="{{ url('batch-delete/' . $batch->id) }}"><i
                                                    class="fas fa-trash  text-white"></i></a>
                                        </button> --}}

                                        <button title="Details" data-id='{{ $batch->id }}'
                                            data-course_id='{{ $batch->course_id }}' data-toggle="modal"
                                            data-target="#admitted-student-details"
                                            class="btn btn-info btn-sm flex items-center batchDetails">Details
                                        </button>

                                    </td>
                                </tr>
                                @include(
                                    'backend.theme.clasic.student.batch.editBatch'
                                )
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if (checkUserType() == 0)
                    <div class="col-md-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title text-center"> Insert Batch Number</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('insert-batch') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="p-2">
                                    <div class="form-group">
                                        <label for="batch_number"> Batch Number </label>
                                        <input class="form-control" id="batch_number" name="batch_number" type="text"
                                            placeholder="Enter Batch Number" data-validation='required'>
                                    </div>
                                    <div class="form-group">
                                        <label>Select Course</label>
                                        <select name="course_id" id="course_id" data-validation='required'
                                            class="form-control select2" style="width: 100%;">
                                            <option selected disabled>Select Course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->course_title }}</option>
                                            @endforeach
                                        </select>
                                        @error('course_id')
                                            <span class="text-danger font-weight-bold">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if (user(Auth::id()) == 1)
                                        <input type="hidden" name="batch_type" class="batch_type" value="Local">
                                    @elseif (user(Auth::id()) == 2)
                                        <input type="hidden" name="batch_type" class="batch_type" value="Global">
                                    @else
                                        <div class="form-group">
                                            <label>Select Course Type</label>
                                            <select id="batch_type" name="batch_type" data-validation='required'
                                                class="form-control select2 batch_type" style="width: 100%;">
                                                <option label="Choose type" selected disabled>Select One</option>
                                                <option value="Local">Local</option>
                                                <option value="Global">Global</option>
                                            </select>
                                            @error('batch_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label>Select Category</label>
                                        <select name="title_id" id="title_id" data-validation='required'
                                            class="form-control select2 title_id" style="width: 100%;">
                                            <option label="Choose category" selected disabled>Select One</option>
                                        </select>
                                        @error('title_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block align-top">
                                            Save</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                @endif
            </div>
        </div>
    </div>
    @include('backend.theme.clasic.student.batch.DetailsModal')
    {{-- @include('backend.theme.clasic.student.batch.batchAndCourseWiseStudent') --}}
    <!-- jQuery -->
    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#admitted-student-details').on('hidden.bs.modal', function() {
                $("#courseId").val("");
                $('#courseName').empty();
                $('#batchNong').empty();
                $('#totalStuent').empty();
                $('#totalAmount').empty();
                $('#totalPaid').empty();
                $('#totalDue').empty();
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            $('.batchDetails').click(function() {
                var batchId = $(this).data("id");
                var course_id = $(this).data("course_id");
                // sessionStorage.setItem("batch_id", batchId);
                $('#courseName').empty();
                $('#batchNong').empty();
                $('#totalStuent').empty();
                $('#totalAmount').empty();
                $('#totalPaid').empty();
                $('#totalDue').empty();
                $.ajax({
                    type: "POST",
                    url: "{{ route('admitted-student-details') }}",
                    data: {
                        'batchId': batchId,
                        'course_id': course_id
                    },
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#courseName').append(':  ' + response.courseName);
                        $('#batchNong').append(':  ' + response.batchNong);
                        $('#totalStuent').append(':  ' + response.totalStudent);
                        $('#totalAmount').append(':  ' + response.total_course_after_discount +
                            ' tk');
                        $('#totalPaid').append(':  ' + response.totalPaid + ' tk');
                        $('#totalDue').append(':  ' + response.totalDue + ' tk');
                        $('#CourseId').attr('value', course_id);
                        $('#BatchId').attr('value', batchId);
                    }
                });
            });
        });
    </script>
    {{-- income type name --}}
    <script>
        $(document).ready(function() {
            $(".batch_type").change(function() {
                var incomeType = $(this).val();
                $.ajax({
                    method: 'POST',
                    type: 'json',
                    data: {
                        incomeType: incomeType
                    },
                    url: "{{ route('income_type_ajax') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $(".title_id").empty();
                        $(".title_id").append(
                            ` <option label="Choose" selected disabled>Select One</option>`
                        );
                        $.each(data, function(index, value) {
                            $(".title_id").append(
                                `<option value="${value.id}">${value.title}</option>`
                            );
                        });
                    },
                    error: function(error) {

                    }

                })
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            var incomeType = $('.batch_type').val();
            $.ajax({
                method: 'POST',
                type: 'json',
                data: {
                    incomeType: incomeType
                },
                url: "{{ route('income_type_ajax') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $(".title_id").empty();
                    $(".title_id").append(
                        ` <option label="Choose" selected disabled>Select One</option>`
                    );
                    $.each(data, function(index, value) {
                        $(".title_id").append(
                            `<option value="${value.id}">${value.title}</option>`
                        );
                    });
                },
                error: function(error) {

                }

            })
        })
    </script>
@endsection
