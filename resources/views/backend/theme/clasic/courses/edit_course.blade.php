@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Edit Course
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('course_active', 'menu-open')

@section('menu_active_course', 'active bg-info')

@section('course_list_active', 'active')
{{-- menu active end --}}

@section('maincontant')
    <form action="{{ route('update-course') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="id" id="id" value="{{ $courses->id }}">
        <input type="hidden" name="old_title" value="{{ $courses->course_title }}">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="course_title">কোর্স টাইটেল</label>
                            <a href="javascript:;" data-toggle="modal" data-target="#title"
                                style="float: right; border-radius: 3px;" class="btn-success">Preview</a>
                            <input type="text" name="course_title" id="course_title" class="form-control"
                                placeholder="Course Title" value="{{ $courses->course_title }}">
                            @error('course_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="course_slug">কোর্স স্লাগ(Slug)</label>

                            <a href="javascript:;" data-toggle="modal" data-target="#title"
                                style="float: right; border-radius: 3px;" class="btn-success">Preview</a>
                            <input type="text" name="course_slug" id="course_slug_edit" class="form-control"
                                placeholder="Course Slug" value="{{ $courses->course_slug }}">
                            @error('course_slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="short_description">ছোট বিবরণ</label> <a href="javascript:;" data-toggle="modal"
                                data-target="#st_description" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <textarea type="text" name="short_description" class="textarea form-control" cols="30"
                                rows="4">{{ $courses->short_description }}</textarea>
                            @error('short_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="long_description">দীর্ঘ বিবরণ</label> <a href="javascript:;" data-toggle="modal"
                                data-target="#lg_description" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>

                            <textarea type="text" name="long_description" class="textarea form-control" cols="30"
                                rows="4">{{ $courses->long_description }}</textarea>
                            @error('long_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="importents">আপনার জন্য কোর্সটি কেন গুরুত্বপূর্ণ ?</label> <a href="javascript:;"
                                data-toggle="modal" data-target="#course_importents"
                                style="float: right; border-radius: 3px;" class="btn-success">Preview</a>
                            <textarea type="text" name="importents" class="textarea form-control" cols="30"
                                rows="4">{{ $courses->importents }}</textarea>
                            @error('importents')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="time_line">কোর্স এর সময়কাল</label> <a href="javascript:;" data-toggle="modal"
                                data-target="#time" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <input type="text" name="time_line" id="time_line" class="form-control"
                                placeholder="Time Line" value="{{ $courses->time_line }}">
                            @error('time_line')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image_alt">আল্টার(alt)</label>
                            <input type="text" name="image_alt" id="image_alt" class="form-control"
                                placeholder="Time Line" value="{{ $courses->image_alt }}">
                            @error('image_alt')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="student_quantity">প্রতি ব্যাচে শিক্ষার্থী সংখ্যা</label> <a href="javascript:;"
                                data-toggle="modal" data-target="#students" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <input type="text" name="student_quantity" id="student_quantity" class="form-control"
                                placeholder="Student Quantity" value="{{ $courses->student_quantity }}">
                            @error('student_quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">কোর্স এর মূল্য (ইংরেজিতে)</label> <a href="javascript:;" data-toggle="modal"
                                data-target="#course_price" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <input type="number" name="price" id="price" class="form-control" placeholder="Price"
                                value="{{ $courses->price }}">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="future_of_this_course">ভবিষ্যৎ সম্ভাবনা</label> <a href="javascript:;"
                                data-toggle="modal" data-target="#future" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>

                            <textarea type="text" name="future_of_this_course" class="textarea form-control" cols="30"
                                rows="4">{{ $courses->future_of_this_course }}</textarea>
                            @error('future_of_this_course')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="possibilities_of_this_course">কোর্স শেষ করার পর আমি কী করতে পারব?</label> <a
                                href="javascript:;" data-toggle="modal" data-target="#possiblities"
                                style="float: right; border-radius: 3px;" class="btn-success">Preview</a>

                            <textarea type="text" name="possibilities_of_this_course" class="textarea form-control" cols="30"
                                rows="4">{{ $courses->possibilities_of_this_course }}</textarea>
                            @error('possibilities_of_this_course')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="course_content">কোর্সের বিষয়বস্তু</label> <a href="javascript:;"
                                data-toggle="modal" data-target="#content" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <textarea type="text" name="course_content" class="textarea form-control" cols="30"
                                rows="4">{{ $courses->course_content }}</textarea>
                            @error('course_content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- //////////////////////////////////////// --}}
                        <div class="form-group">
                            <label for="image">থামনেইল</label> <a href="javascript:;" data-toggle="modal"
                                data-target="#thumbnail" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <input type="file" name="image" id="inputImg" onchange="preview()" class="form-control"
                                placeholder="image" value="{{ $courses->image }}">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <input type="hidden" value="{{ $courses->image }}" name='oldImg'>
                            <p id="para">Old Image</p>
                            <img width="250px" id="old_img" style=" border: 2px solid gray; padding: 20px;"
                                class="old_img" src="{{ asset($courses->image) }}" alt="old image">

                            <span>
                                <img src="" id="reviewImg">
                            </span>
                        </div>
                    </div>
                </div>
                <div class="pt-2">
                    <button type="submit" class="btn btn-block btn-primary">
                        Update</button>
                </div>
            </div>
            @include(
                'backend/theme/clasic/include/modal_photos/modal'
            )
    </form>

    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $("#course_slug_edit").blur(function() {
            var course_slug = $('#course_slug_edit').val();
            var course_id = $('#id').val();


            var slug = course_slug.toLowerCase();
            const replace = slug.replace(/\s/g, '-');
            // alert(replace);
            if (replace) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'GET',
                    datatype: 'json',

                    url: "{{ url('/course-slug-edit') }}/" + replace + '/' + course_id,
                    success: function(data) {
                        if (data == 1) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Your Slug Is Not Unique!',
                            })
                            $('#course_slug_edit').val('');
                        }

                    },

                    error: function(data, textStatus, errorThrown) {
                        console.log(data);
                    }
                })
            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill the Course Slug!',
                })

            }
        });
    </script>
    <script>
        function preview() {
            // const preview = document.querySelector('#imgThambnail');
            const file = document.querySelector('#inputImg').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function(e) {
                // convert image file to base64 string
                // preview.src = reader.result;
                $('#reviewImg').attr('src', e.target.result).width(250).height(180);

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
@endsection
