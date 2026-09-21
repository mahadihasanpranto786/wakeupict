@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Blog Contents List
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('blog_active', 'menu-open')

@section('menu_active_blog', 'active bg-info')

@section('blog_list_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <a title="Back" href="{{ URL::previous() }}" class="btn btn-dark btn-sm">
                <i class="fas fa-hand-point-left text-light"></i></a>
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Blog Contents List
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="my-1">

                                @if (checkUserType() == 0)
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#add_blog_content">
                                        <i class="fas fa-plus-circle"></i> Add Blog Content
                                    </button>
                                @endif
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">SL</th>
                                        <th style="width: 30%">থামনেইল</th>
                                        <th style="width: 10%">অল্টার</th>
                                        <th style="width: 10%">টাইটেল</th>
                                        <th style="width: 15%">কন্টেন্ট সাজান</th>
                                        <th style="width: 10%">অর্ডারিং</th>
                                        @if (checkUserType() == 0)
                                            <th style="width: 20%">Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($blogContents as $blogContent)
                                        <tr>
                                            <td> {{ $serial++ }}</td>
                                            <td>
                                                @if ($blogContent->file_1 != null)
                                                    <img width="60px" src="{{ URL::asset($blogContent->file) }}"
                                                        alt="blog image">
                                                    <img width="60px" src="{{ URL::asset($blogContent->file_1) }}"
                                                        alt="blog image">
                                                    <img width="60px" src="{{ URL::asset($blogContent->file_1) }}"
                                                        alt="blog image">
                                                @elseif($blogContent->file == null)
                                                    Only Text Content
                                                @else
                                                    <img width="80px" src="{{ URL::asset($blogContent->file) }}"
                                                        alt="blog image">
                                                @endif

                                            </td>
                                            <td>{{ $blogContent->image_alt }}
                                            </td>
                                            <td>{{ $blogContent->title }} </td>
                                            <td>{!! $blogContent->content_design !!} </td>
                                            <td>{!! $blogContent->order !!} </td>
                                            @if (checkUserType() == 0)
                                                <td class="border">
                                                    <div>
                                                        {{-- view --}}
                                                        <button title="View" class="btn btn-info btn-sm"> <a
                                                                class="flex items-center "
                                                                href="{{ url('view-blog-content/' . $blogContent->id) }}"><i
                                                                    class="fas fa-eye text-white"></i>
                                                            </a>
                                                        </button>
                                                        {{-- edit --}}

                                                        {{-- <button title="View" class="btn btn-info btn-sm"> <a
                                                            class="flex items-center "
                                                            href="{{ url('edit-blog-content/' . $blogContent->id) }}"><i
                                                                class="fas fa-eye text-white"></i>
                                                        </a>
                                                    </button> --}}
                                                        <button class='singleBlogContent btn btn-primary btn-sm'
                                                            data-single='{{ $blogContent->content_design }}' title="Edit"
                                                            data-toggle="modal"
                                                            data-target="#editBlogContent{{ $blogContent->id }}"><i
                                                                class="fas fa-pencil-alt text-white"></i>
                                                        </button>

                                                        {{-- delete --}}
                                                        <button title="Delete" class="btn btn-danger btn-sm"><a
                                                                class="flex items-center " id="delete"
                                                                href="{{ url('delete-blog-content/' . $blogContent->id) }}"><i
                                                                    class="fas fa-trash  text-white"></i></a>
                                                        </button>


                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                        @include(
                                            'backend/theme/clasic/blog/blog_include/editBlogContent'
                                        )
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="float-right mx-2">
                            {{ $blogContents->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    @include(
        'backend/theme/clasic/blog/blog_include/insertBlogContent'
    )

    @include('backend/theme/clasic/include/modal_photos/modal')
    <!-- jQuery -->
    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>

    {{-- insert blog content --}}
    <script>
        $("#file").show();
        $("#file_other, #file_other_2, #imgBlog1, #imgBlog2, #preview_img_multiple, .previewRight").hide().css("padding",
            0);
        value = $('#content_design').val();
        if (value == 'Top Three' || value == 'Right Three') {
            $("#file_other, #file_other_2,  #imgBlog1, #imgBlog2, #preview_img_multiple").show();
            $("#preview_img_single").hide();
            $("#file, #file_type, #image_alt").show();
        } else if (value == 'Only Text') {
            $("#file_other, #file_other_2, #imgBlog1, #imgBlog2").hide().css("padding", 0);
            $("#file, #file_type, #image_alt").hide();
        } else if (value == 'Left side' || value == 'Right side' || value == 'Middle') {
            $("#file_other, #file_other_2, #imgBlog1, #imgBlog2").hide().css("padding", 0);
            $("#file, #file_type, #image_alt").show();
        } else {
            $("#file_other, #file_other_2, #imgBlog1, #imgBlog2").hide().css("padding", 0);
        }

        $('#content_design').change(function() {
            value = $(this).val();
            if (value == 'Top Three') {
                $("#file_other, #file_other_2,  #imgBlog1, #imgBlog2, #preview_img_multiple,.previewMulti").show();
                $("#preview_img_single , .previewRight").hide();
                $("#file, #file_type, #image_alt").show();
            } else if (value == 'Right Three') {
                $("#file_other, #file_other_2,  #imgBlog1, #imgBlog2, #preview_img_multiple, .previewRight").show();
                $("#preview_img_single ,#preview_img_single , #preview_img_multiple ,.previewMulti").hide();
                $("#file, #file_type, #image_alt").show();
            } else if (value == 'Only Text') {
                $("#file_other, #file_other_2, #imgBlog1, #imgBlog2").hide().css("padding", 0);
                $("#file, #file_type, #image_alt").hide();
            } else if (value == 'Left side' || value == 'Right side' || value == 'Middle') {
                $("#file_other, #file_other_2, #imgBlog1, #imgBlog2, #preview_img_multiple ,.previewMulti").hide()
                    .css("padding", 0);
                $("#file, #file_type, #image_alt,#preview_img_single").show();
            } else {
                $("#file_other, #file_other_2, #imgBlog1, #imgBlog2").hide().css("padding", 0);
            }
        });
    </script>

    {{-- edit blog content --}}
    <script>
        $("#file_edit").show();
        $("#file_other_edit, #file_other_2_edit, #imgBlog1_edit, #imgBlog2_edit, #preview_img_multiple_edit").hide().css(
            "padding", 0);
        $(".singleBlogContent").click(function() {
            value = $(this).data('single');
            if (value == 'Top Three' || value == 'Right Three') {
                $("#file_other_edit, #file_other_2_edit,  #imgBlog1_edit, #imgBlog2_edit, #preview_img_multiple_edit")
                    .show();
                $("#preview_img_single_edit").hide();
                $("#file_edit, #file_type_edit, #image_alt_edit").show();
            } else if (value == 'Only Text') {
                $("#file_other_edit, #file_other_2_edit, #imgBlog1_edit, #imgBlog2_edit").hide().css("padding", 0);
                $("#file_edit, #file_type_edit, #image_alt_edit, #priview_hide").hide();
            } else if (value == 'Left side' || value == 'Right side' || value == 'Middle') {
                $("#file_other_edit, #file_other_2_edit, #imgBlog1_edit, #imgBlog2_edit").hide().css("padding", 0);
                $("#file_edit, #file_type_edit, #image_alt_edit").show();
            } else {
                $("#file_other_edit, #file_other_2_edit, #imgBlog1_edit, #imgBlog2_edit").hide().css("padding", 0);
            }

            $('.content_design_edit').change(function() {
                value = $(this).val();
                if (value == 'Top Three' || value == 'Right Three') {
                    $("#file_other_edit, #file_other_2_edit,  #imgBlog1_edit, #imgBlog2_edit, #preview_img_multiple_edit")
                        .show();
                    $("#preview_img_single_edit").hide();
                    $("#file_edit, #file_type_edit, #image_alt_edit").show();
                } else if (value == 'Only Text') {
                    $("#file_other_edit, #file_other_2_edit, #imgBlog1_edit, #imgBlog2_edit").hide().css(
                        "padding", 0);
                    $("#file_edit, #file_type_edit, #image_alt_edit, #priview_hide").hide();
                } else if (value == 'Left side' || value == 'Right side' || value == 'Middle') {
                    $("#file_other_edit, #file_other_2_edit, #imgBlog1_edit, #imgBlog2_edit").hide().css(
                        "padding", 0);
                    $("#file_edit, #file_type_edit, #image_alt_edit").show();
                } else {
                    $("#file_other_edit, #file_other_2_edit, #imgBlog1_edit, #imgBlog2_edit").hide().css(
                        "padding", 0);
                }
            });

        })
    </script>
    {{-- modal hide start --}}
    <script>
        $("button[data-dismiss='modal2']").click(function() {
            $('#blog_content_title, #blog_content_design, #blog_content_file, #blog_content_file_multiple, #file_1, #file_2, #blog_content_description, .previewRightFirst, .previewRightSecond, .previewRightThird')
                .modal('hide');
            $('body').css("overflow", "").css("overflow-y", "");
            $('body').css("overflow", "hidden");
            $(".modal-open .modal").css("overflow-x", "hidden").css("overflow-y", "auto");
        });
    </script>
    <script>
        $("button[data-dismiss='modal3']").click(function() {
            $('#add_blog_content, .editBlogContent')
                .modal('hide');
            $('body').css("overflow", "").css("overflow-y", "");
            // $('body').css("overflow", "hidden").css("overflow-y", "auto");
            $(".modal-open .modal").css("overflow-x", "hidden").css("overflow-y", "auto");
        });
    </script>
    {{-- modal hide end --}}
    {{-- image preview --}}
    <script>
        function blog_prview() {
            const file = document.querySelector('#inputImg').files[0];
            const reader = new FileReader();
            reader.addEventListener("load", function(e) {
                var previewImg = $('#imgBlog').attr('src', e.target.result).width(250).height(180);
            }, false);
            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function blog_prview_1() {
            const file = document.querySelector('#inputImg1').files[0];
            const reader = new FileReader();
            reader.addEventListener("load", function(e) {
                var previewImg = $('#imgBlog1').attr('src', e.target.result).width(250).height(180);
            }, false);
            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function blog_prview_2() {
            const file = document.querySelector('#inputImg2').files[0];
            const reader = new FileReader();
            reader.addEventListener("load", function(e) {
                var previewImg = $('#imgBlog2').attr('src', e.target.result).width(250).height(180);
            }, false);
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
    {{-- edit content design --}}

    <script>
        function blog_prview_edit() {
            const file = document.querySelector('#inputImg_edit').files[0];
            const reader = new FileReader();
            reader.addEventListener("load", function(e) {
                $('#imgBlog_edit').attr('src', e.target.result).width(150).height(150);

            }, false);

            if (file) {
                reader.readAsDataURL(file);
                document.querySelector("#preview_img_edit").removeAttribute('src');
                document.querySelector("#preview_img_edit").removeAttribute('alt');
                document.querySelector("#preview_img_edit").removeAttribute('style');
                document.querySelector('#para_edit').innerHTML = 'New image';
                document.getElementById("reviewImg").style.cssText = `
                                border: 2px solid gray;
                                padding: 20px;
                                `;
            }
        }

        function blog_prview_1_edit() {
            const file = document.querySelector('#inputImg1_edit').files[0];
            const reader = new FileReader();
            reader.addEventListener("load", function(e) {
                var previewImg = $('#imgBlog1_edit').attr('src', e.target.result).width(250).height(180);
            }, false);
            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function blog_prview_2_edit() {
            const file = document.querySelector('#inputImg2_edit').files[0];
            const reader = new FileReader();
            reader.addEventListener("load", function(e) {
                var previewImg = $('#imgBlog2_edit').attr('src', e.target.result).width(250).height(180);
            }, false);
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
