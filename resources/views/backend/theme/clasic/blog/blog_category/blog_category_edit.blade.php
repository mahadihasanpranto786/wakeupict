@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Create About
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
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('update-blog-cagegory') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $blog_Category->id }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="category_name">Category Name</label>
                            <input type="text" name="category_name" id="category_name" class="form-control"
                                placeholder="Course Title" value="{{ $blog_Category->category_name }}">
                            @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <label for="short_description">Description</label>
                        <textarea type="text" name="short_description" class="textarea form-control" cols="30"
                            rows="4">{{ $blog_Category->short_description }}</textarea>
                        @error('short_description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="pt-2">
                            <button type="submit" class="btn btn-primary">
                                Insert</button>
                        </div>
                </form>
            </div>
        </div>

        @include('backend/theme/clasic/include/modal_photos/modal')
    </div>

@endsection
