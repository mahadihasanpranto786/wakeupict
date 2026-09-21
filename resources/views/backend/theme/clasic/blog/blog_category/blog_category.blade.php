@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Blog Category List
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('blog_active', 'menu-open')

@section('menu_active_blog', 'active bg-info')

@section('blog_category_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Blog Category List
                    </h3>

                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            @if (checkUserType() == 0)
                                <button type="button" class="btn btn-primary my-2" data-toggle="modal"
                                    data-target="#add_blog_category">
                                    <i class="fas fa-plus-circle"></i> Add Blog Category
                                </button>
                            @endif
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">SL</th>
                                        <th style="width: 20%">টাইটেল</th>
                                        <th style="width: 55%">ছোট বিবরন</th>
                                        @if (checkUserType() == 0)
                                            <th style="width: 15%">Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($blog_Category as $category)
                                        <tr>
                                            <td> {{ $serial++ }}</td>
                                            <td>
                                                {{ $category->category_name }} </td>
                                            <td>{!! $category->short_description !!}
                                            </td>
                                            @if (checkUserType() == 0)
                                                <td class="border">
                                                    <div>
                                                        {{-- edit --}}

                                                        <button title="Edit" class="btn btn-primary btn-sm"> <a
                                                                class="flex items-center "
                                                                href="{{ url('edit-blog-category/' . $category->id . '/' . $category->category_name) }}"><i
                                                                    class="fas fa-pencil-alt text-white"></i>
                                                            </a>
                                                        </button>

                                                        {{-- delete --}}
                                                        <button title="Delete" class="btn btn-danger btn-sm"><a
                                                                class="flex items-center " id="delete"
                                                                href="{{ url('delete-blog-category/' . $category->id . '/' . $category->category_name) }}"><i
                                                                    class="fas fa-trash  text-white"></i></a>
                                                        </button>

                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    {{-- {{ $blog_Category->links() }} --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="modal fade" id="add_blog_category" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h1 class="text-center"> Add Blog Category</h1> <br>
                        </div>

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-lg font-medium mr-auto">

                        </h2>
                        <form action="{{ route('store-blog-categry') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                {{-- <input type="hidden" name="id" value=""> --}}
                                <label for="category_name" class="form-label">Category Name:</label><a
                                    href="javascript:;" data-toggle="modal" data-target="#blog_category_name"
                                    style="float: right; border-radius: 3px;" class="btn-success">Preview</a>
                                <input id="category_name" name="category_name" type="text" class="form-control"
                                    placeholder="Enter Category Name" value="{{ old('category_name') }}">
                                @error('category_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="short_description" class="form-label">Short Description</label>
                                <textarea type="text" name="short_description" class=" form-control" cols="30"
                                    rows="4">{{ old('short_description') }}</textarea>
                                @error('short_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary  mt-5">Submit</button>
                            </div>
                        </form>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>
        </div>
        @include('backend/theme/clasic/include/modal_photos/modal')
    </div>
    <script>
        function courseImg() {
            // const preview = document.querySelector('#imgThambnail');
            const file = document.querySelector('#inputImg').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function(e) {
                // convert image file to base64 string
                // preview.src = reader.result;
                $('#imgBlog').attr('src', e.target.result).width(250).height(180);

            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        // select 2


        // $(document).ready(function() {
        //     $('.select2').select2()
        // });
    </script>

@endsection
