@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Blogs List
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
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Blogs List
                    </h3>
                </div>

                @php
                    $Add_blog = 0;
                    foreach (userRolls() as $roll) {
                        if ($roll->module_id == 53) {
                            $Add_blog = 53;
                        }
                    }
                @endphp

                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="my-1">
                                @if ((checkUserType() == 0 && $Add_blog != 0) || Auth::user()->type == 'Admin')
                                    <a href="{{ route('create-blog') }}">
                                        <button class="btn btn-primary  align-top"><i class="fas fa-plus-circle"></i> Add
                                            Blog
                                        </button>
                                    </a>
                                @endif
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>থামনেইল</th>
                                        <th>অল্টার</th>
                                        <th>ব্লোগ টাইটেল</th>
                                        <th>লেখক</th>
                                        <th>ফুটার টাইটেল</th>
                                        {{-- <th >টেমপ্লেটের নাম</th> --}}
                                        <th>স্লাগ</th>
                                        <th>স্টেটাস</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($blogs as $item)
                                        <tr>
                                            <td> {{ $serial++ }}</td>
                                            <td><img width="80px" src="{{ URL::asset($item->blog_image) }}"
                                                    alt="blog image">
                                            </td>
                                            <td>{{ $item->image_alt }} </td>
                                            <td>{{ $item->blog_title }} </td>
                                            <td>{{ $item->creator_name }} </td>
                                            {{-- <td >{!! $item->templete_name !!} </td> --}}
                                            <td>{{ $item->footer_title }} </td>
                                            <td>{{ $item->slug_title }} </td>
                                            <td>
                                                @if ($item->active_blog == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="border">
                                                <div class="d-flex">
                                                    @if (checkUserType() == 0)
                                                        {{-- status --}}
                                                        @if ($item->active_blog == 1)
                                                            <a title="Inactive"
                                                                class="flex items-center btn btn-danger btn-sm"
                                                                href="{{ url('blog-inactive/' . $item->id) }}"> <i
                                                                    class="fas fa-arrow-circle-down text-white"></i></a>
                                                        @else
                                                            <a title="Active"
                                                                class="flex items-center btn btn-success btn-sm"
                                                                href="{{ url('blog-active/' . $item->id) }}"> <i
                                                                    class="fas fa-arrow-circle-up text-white"></i></a>
                                                        @endif
                                                        <a title="View" class="flex items-center btn btn-info btn-sm"
                                                            href="{{ url('view-this-blog/' . $item->id) }}"><i
                                                                class="fas fa-eye text-white"></i>
                                                        </a>
                                                    @endif
                                                    @if ((checkUserType() == 0 && $Add_blog != 0) || Auth::user()->type == 'Admin')
                                                        {{-- edit --}}
                                                        <a title="Edit" class="flex items-center btn btn-primary btn-sm"
                                                            href="{{ url('edit-blog/' . $item->id) }}"><i
                                                                class="fas fa-pencil-alt text-white"></i>
                                                        </a>
                                                    @endif

                                                    @if (checkUserType() == 0)
                                                        {{-- delete --}}
                                                        <a title="Delete" class="flex items-center btn btn-danger btn-sm"
                                                            id="delete" href="{{ url('delete-blog/' . $item->id) }}"><i
                                                                class="fas fa-trash  text-white"></i></a>
                                                    @endif
                                                </div>

                                                @if (checkUserType() == 0)
                                                    <a title="Add Content"
                                                        class="flex items-center my-1 text-white btn btn-block btn-primary btn-sm"
                                                        href="{{ url('blog-content-list/' . $item->id) }}">
                                                        <small>Blog Content </small> </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
@endsection
