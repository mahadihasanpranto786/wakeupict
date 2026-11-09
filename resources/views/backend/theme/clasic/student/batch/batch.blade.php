@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Student Batch Management
@endsection
{{-- menu active start --}}
@section('student_active', 'menu-open')

@section('menu_active_active', 'active')

@section('batch_list_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title font-weight-bold">
                <i class="fas fa-layer-group mr-2"></i> Dynamic Batch Management
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle mr-1"></i> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-md-8">
                    <table id="example1" class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width: 5%">SL</th>
                                <th>Batch Name / Number</th>
                                <th>Batch Code</th>
                                <th>Year</th>
                                <th>Course</th>
                                <th>Batch Duration</th>
                                <th>Status</th>
                                <th style="width: 22%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $serial = 1;
                            @endphp
                            @foreach ($batches as $batch)
                                <tr>
                                    <td>{{ $serial++ }}</td>
                                    <td>
                                        <strong>{{ $batch->batch_number }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge badge-info font-weight-bold font-mono">{{ $batch->batch_code }}</span>
                                        @if($batch->isUsedInRegistration())
                                            <i class="fas fa-lock text-muted ml-1" title="Used in registration (Code locked)"></i>
                                        @endif
                                    </td>
                                    <td>{{ $batch->academic_year ?: date('Y') }}</td>
                                    <td>{{ $batch->course ? $batch->course->course_title : 'N/A' }}</td>
                                    <td>
                                        @if($batch->start_date || $batch->end_date)
                                            <div class="small font-weight-bold">
                                                {{ $batch->start_date ? $batch->start_date->format('d M Y') : 'Start' }}
                                                <i class="fas fa-arrow-right mx-1 text-muted text-xs"></i>
                                                {{ $batch->end_date ? $batch->end_date->format('d M Y') : 'Ongoing' }}
                                            </div>
                                            @if($batch->end_date && \Carbon\Carbon::parse($batch->end_date)->endOfDay()->isPast())
                                                <span class="badge badge-danger text-xs mt-1"><i class="fas fa-clock mr-1"></i> Expired (Access Closed)</span>
                                            @else
                                                <span class="badge badge-success text-xs mt-1"><i class="fas fa-check-circle mr-1"></i> Running Batch</span>
                                            @endif
                                        @else
                                            <span class="text-muted small">Not set</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($batch->active_batch == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="border">
                                        @if (checkUserType() == 0)
                                            {{-- Active / Inactive Toggle --}}
                                            @if ($batch->active_batch == 1)
                                                <a class="btn btn-warning btn-sm" title="Deactivate Batch" href="{{ url('batch-inactive/' . $batch->id) }}">
                                                    <i class="fas fa-pause text-dark"></i>
                                                </a>
                                            @else
                                                <a class="btn btn-success btn-sm" title="Activate Batch" href="{{ url('batch-active/' . $batch->id) }}">
                                                    <i class="fas fa-play text-white"></i>
                                                </a>
                                            @endif

                                            {{-- Edit modal button --}}
                                            <button title="Edit Batch" data-toggle="modal" data-target="#editBatchModal{{ $batch->id }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-pencil-alt text-white"></i>
                                            </button>

                                            {{-- Delete button (Prevented if has registered students) --}}
                                            <a class="btn btn-danger btn-sm" title="Delete Batch" onclick="return confirm('Are you sure you want to delete this batch?')" href="{{ url('batch-delete/' . $batch->id) }}">
                                                <i class="fas fa-trash text-white"></i>
                                            </a>
                                        @endif

                                        <button title="Details" data-id='{{ $batch->id }}'
                                            data-course_id='{{ $batch->course_id }}' data-toggle="modal"
                                            data-target="#admitted-student-details"
                                            class="btn btn-info btn-sm batchDetails">
                                            <i class="fas fa-info-circle"></i> Details
                                        </button>
                                    </td>
                                </tr>
                                @include('backend.theme.clasic.student.batch.editBatch')
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if (checkUserType() == 0)
                    <div class="col-md-4">
                        <div class="card card-primary card-outline shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title font-weight-bold mb-0">
                                    <i class="fas fa-plus-circle mr-1"></i> Create New Batch
                                </h3>
                            </div>
                            <!-- form start -->
                            <form method="POST" action="{{ route('insert-batch') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body p-3">
                                    <div class="form-group">
                                        <label for="batch_number">Batch Name / Batch Number <span class="text-danger">*</span></label>
                                        <input class="form-control" id="batch_number" name="batch_number" type="text"
                                            placeholder="e.g. Batch-05 or 05" value="{{ old('batch_number') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="batch_code">Batch Code (Unique) <span class="text-danger">*</span></label>
                                        <input class="form-control font-weight-bold" id="batch_code" name="batch_code" type="text"
                                            placeholder="e.g. 05, 105, B01" value="{{ old('batch_code') }}" required maxlength="20">
                                        <small class="text-muted">Can be 2 or more digits. Used in student registration numbers.</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="academic_year">Academic Year <span class="text-danger">*</span></label>
                                        <input class="form-control" id="academic_year" name="academic_year" type="text"
                                            placeholder="e.g. {{ date('Y') }}" value="{{ old('academic_year', date('Y')) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Select Course <span class="text-danger">*</span></label>
                                        <select name="course_id" id="course_id" required class="form-control select2" style="width: 100%;">
                                            <option selected disabled value="">Select Course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                                    {{ $course->course_title }} (Code: {{ $course->course_code }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="start_date">Start Date <span class="text-danger">*</span></label>
                                                <input class="form-control" id="start_date" name="start_date" type="date" value="{{ old('start_date') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="end_date">End Date <span class="text-danger">*</span></label>
                                                <input class="form-control" id="end_date" name="end_date" type="date" value="{{ old('end_date') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-muted d-block mb-3">
                                        <i class="fas fa-info-circle text-info"></i> ব্যাচের End Date পার হয়ে গেলে শিক্ষার্থীদের স্টুডেন্ট পোর্টাল অ্যাক্সেস স্বয়ংক্রিয়ভাবে বন্ধ হয়ে যাবে।
                                    </small>

                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-primary btn-block font-weight-bold">
                                            <i class="fas fa-save mr-1"></i> Save Batch
                                        </button>
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

    <!-- jQuery -->
    <script src="{{ safe_asset('admin/plugins/jquery/jquery.min.js') }}"></script>
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
                        $('#totalAmount').append(':  ' + response.total_course_after_discount + ' tk');
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
                    }
                });
            });

            // Initial load
            var incomeType = $('.batch_type').val() || 'Local';
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
                }
            });
        });
    </script>
@endsection
