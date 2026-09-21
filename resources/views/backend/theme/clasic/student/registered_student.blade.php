@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Register Student
@endsection
{{-- menu active start --}}
@section('student_active', 'menu-open')

@section('menu_active_active', 'active')

@section('student_list_active', 'active')
{{-- menu active end --}}

@section('maincontant')
    <style>
        span.help-block.form-error {
            color: red;
        }

    </style>
    <div class="card">
        <div class="card-body">

            <form action="{{ route('register-student') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $student->id }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="student_name">Student Name</label>
                            <input type="text" data-validation='required' name="student_name" id="student_name"
                                class="form-control" placeholder="Enter Student Name"
                                value="{{ $student->student_name }}">
                            @error('student_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>Select Course</label>
                            <select name="course_id" id="course_id" data-validation='required' class="form-control select2"
                                style="width: 100%;">
                                <option selected disabled>Select One</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{ $course->id == $student->course_id ? 'selected' : '' }}>
                                        {{ $course->course_title }}</option>
                                @endforeach

                            </select>
                            @error('course_id')
                                <span class="text-danger font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Batch Number</label>
                            <select name="batch_id" id="batch_id" data-validation='required' class="form-control select2"
                                style="width: 100%;">
                                <option selected disabled>Choose Batch</option>

                            </select>
                            @error('batch_id')
                                <span class="text-danger font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="course_fee">Course Fee (TK) [ <span class="text-danger">Note:</span>Course
                                Fee Must Numaric ]</label>
                            <input type="number" data-validation='required' name="course_fee" id="course_fee"
                                class="form-control" placeholder="Enter Course Fee" value="{{ $student->course_fee }}">
                        </div>
                        <div class="form-group">
                            <label for="discount_amount">Discount Amount (Optional)</label>
                            <input type="number" name="discount_amount" id="discount_amount" class="form-control"
                                placeholder="Enter Course Discount">
                        </div>
                        <div class="form-group">
                            <label for="course_after_discount">Grand Total (TK)</label>
                            <input type="text" data-validation='required' name="course_after_discount"
                                id="course_after_discount" class="form-control" placeholder="Enter Grand Total" readonly
                                value="{{ $student->course_fee }}">
                        </div>

                        <div class="form-group">
                            <label for="fathers_name">Father's Name</label>
                            <input type="text" data-validation='required' name="fathers_name" id="fathers_name"
                                class="form-control" placeholder="Enter Father's Name"
                                value="{{ $student->fathers_name }}">
                            @error('fathers_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="mothers_name">Mother's Name</label>
                            <input type="text" data-validation='required' name="mothers_name" id="mothers_name"
                                class="form-control" placeholder="Enter Mother's Name"
                                value="{{ $student->mothers_name }}">
                            @error('mothers_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="religion">Religion</label>
                            <input type="text" data-validation='required' name="religion" id="religion"
                                class="form-control" placeholder="Enter Religion" value="{{ $student->religion }}">
                            @error('religion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="occupation">Occupation</label>
                            <input type="text" data-validation='required' name="occupation" id="occupation"
                                class="form-control" placeholder="Enter Occupation" value="{{ $student->occupation }}">
                            @error('occupation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="age">Date Of Birth</label>
                            <input type="text" data-validation='required' name="age" id="datepicker" class="form-control"
                                placeholder="Enter Date Of Birth" value="{{ $student->age }}">
                            @error('age')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group py-3">
                            <label>Gander &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio1" checked name="gander"
                                    value="male" {{ 'male' == $student->gander ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio1">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineRadio2" name="gander" value="female"
                                    {{ 'female' == $student->gander ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio2">Female</label>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="personal_call_no">Parsonal Call No</label>
                            <input type="number" data-validation='required' name="personal_call_no" id="personal_call_no"
                                class="form-control" placeholder="Enter Parsonal Numbner"
                                value="{{ $student->personal_call_no }}">
                            @error('personal_call_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>Educational Qualification</label>
                            <select name="educational_qualification" data-validation='required' class="form-control select2"
                                style="width: 100%;">
                                <option selected disabled>Choose One</option>
                                <option value="Masters"
                                    {{ 'Masters' == $student->educational_qualification ? 'selected' : '' }}>Masters
                                </option>
                                <option value="Honers"
                                    {{ 'Honers' == $student->educational_qualification ? 'selected' : '' }}>Honers
                                </option>
                                <option value="H.S.C"
                                    {{ 'H.S.C' == $student->educational_qualification ? 'selected' : '' }}>
                                    H.S.C</option>
                                <option value="S.S.C"
                                    {{ 'S.S.C' == $student->educational_qualification ? 'selected' : '' }}>
                                    S.S.C</option>
                                <option value="Others"
                                    {{ 'Others' == $student->educational_qualification ? 'selected' : '' }}>Others
                                </option>
                            </select>
                            @error('educational_qualification')
                                <span class="text-danger font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="result">Result</label>
                            <input type="text" data-validation='required' name="result" id="result" class="form-control"
                                placeholder="Enter Academic Result" value="{{ $student->result }}">
                            @error('result')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="passing_year">Passing Year</label>
                            <input type="text" data-validation='required' name="passing_year" id="passing_year"
                                class="form-control" placeholder="Enter Passing Year"
                                value="{{ $student->passing_year }}">
                            @error('passing_year')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nationality">Nationality</label>
                            <input type="text" data-validation='required' name="nationality" id="nationality"
                                class="form-control" placeholder="Enter Nationality"
                                value="{{ $student->nationality }}">
                            @error('nationality')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="national_id_no">National Id No</label> <input type="text" data-validation='required'
                                name="national_id_no" id="national_id_no" class="form-control"
                                placeholder="Enter National Id No" value="{{ $student->national_id_no }}">
                            @error('national_id_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" data-validation='required' name="email" id="email" class="form-control"
                                placeholder="Enter Email" value="{{ $student->email }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="present_address">Present Address</label>
                            <textarea type="text" data-validation='required' name="present_address" class="form-control" cols="30" rows="4"
                                placeholder="Enter Present Address">{{ $student->present_address }}</textarea>
                            @error('present_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="permanent_address">Permanent Address</label>
                            <textarea type="text" data-validation='required' name="permanent_address" class="form-control" cols="30" rows="4"
                                placeholder="Enter Permanent Address">{{ $student->permanent_address }}</textarea>
                            @error('permanent_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="student_photo">Student Photo</label>
                            <input type="file" id="inputImg" onchange="preview()" name="student_photo"
                                class="form-control" placeholder="student_photo" value="{{ $student->student_photo }}">
                            @error('student_photo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="oldImg" value="{{ $student->student_photo }}">
                            <p id="para">Preview</p>
                            <img width="150px" id="old_img" style=" border: 2px solid gray; padding: 20px;"
                                class="old_img" src="{{ URL::asset($student->student_photo) }}" alt="old image">

                            <span>
                                <img src="" id="reviewImg">
                            </span>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">
                        Register</button>
                </div>
            </form>
        </div>

    </div>
    <script>
        function preview() {
            // const preview = document.querySelector('#imgThambnail');
            const file = document.querySelector('#inputImg').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function(e) {
                // convert image file to base64 string
                // preview.src = reader.result;
                $('#reviewImg').attr('src', e.target.result).width(150).height(150);

            }, false);

            if (file) {
                reader.readAsDataURL(file);
                document.querySelector("#old_img").removeAttribute('src');
                document.querySelector("#old_img").removeAttribute('alt');
                document.querySelector("#old_img").removeAttribute('style');
                document.querySelector('#para').innerHTML = 'New image';
                document.getElementById("reviewImg").style.cssText = `
                            border: 2px solid gray;
                            padding: 20px;
                            `;
            }
        }
    </script>
    <!-- jQuery -->
    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            // var courseFee = $("#course_fee").val();
            // var grandTotal = courseFee - $(this).val();
            // $("#course_after_discount").val(grandTotal);
            // $("#discount_amount").keyup(function() {
            //     var courseFee = $("#course_fee").val();
            //     var grandTotal = courseFee - $(this).val();
            //     $("#course_after_discount").val(grandTotal);
            // });
            $("#course_id").change(function() {
                var course_id = $(this).val();
                $.ajax({
                    method: 'POST',
                    type: 'json',
                    data: {
                        course_id: course_id
                    },
                    url: "{{ route('course_fee_ajax') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        parseInt($("#course_fee").val(data));
                        $("#course_after_discount").val(data);


                    },
                    error: function(error) {

                    }

                })
            })

            $("#discount_amount").keyup(function() {
                var discount = parseInt('');
                var courseFee = $("#course_fee").val();
                var discount = parseInt($(this).val());
                var grandTotal = courseFee - discount;
                if (isNaN(grandTotal)) {
                    $("#course_after_discount").val(courseFee);
                } else {
                    $("#course_after_discount").val(grandTotal);
                }
            });
        })
    </script>

    {{-- course wise batch --}}
    <script>
        $(document).ready(function() {
            $("#course_id").change(function() {
                var courseId = $(this).val();
                console.log(courseId);
                $.ajax({
                    type: "POST",
                    url: "{{ route('courseWiseBatchAjax') }}",
                    data: {
                        courseId: courseId,
                    },
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#batch_id').empty();

                        $('#batch_id').append(`<option selected disabled>Choose Batch</option>`)
                        $.each(response, function(index, value) {
                            $('#batch_id').append(`
                                    <option value="${value.id}">${value.batch_number} (${value.course.course_title})</option>
                            `)
                        });
                    }
                });
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            var courseId = $("#course_id").val();
            $.ajax({
                type: "POST",
                url: "{{ route('courseWiseBatchAjax') }}",
                data: {
                    courseId: courseId,
                },
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#batch_id').empty();

                    $('#batch_id').append(`<option selected disabled>Choose Batch</option>`)
                    $.each(response, function(index, value) {
                        $('#batch_id').append(`
                                    <option value="${value.id}">${value.batch_number} (${value.course.course_title})</option>
                            `)
                    });
                }
            });
        });
    </script>
@endsection
