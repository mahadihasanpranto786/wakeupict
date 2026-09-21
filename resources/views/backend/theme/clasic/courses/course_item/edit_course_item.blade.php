@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Update Course Item
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('course_active', 'menu-open')

@section('menu_active_course', 'active bg-info')

@section('course_list_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('update-course-item') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $course_items->id }}">
                    <div class="card-body">

                        <div>
                            <label for="item_title">টাইটেল</label>
                            <input type="text" name="item_title" id="item_title" class="form-control" placeholder="Title"
                                value="{{ $course_items->item_title }}">
                            @error('item_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="course_order">কোর্স সিরিয়াল নংঃ</label>
                            <input type="number" name="course_order" id="course_order" class="form-control "
                                placeholder="Course Order" value="{{ $course_items->course_order }}">
                            @error('course_order')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="description">বিবরণ</label>
                            <textarea type="text" name="description" class="textarea form-control" cols="30"
                                rows="4">{{ $course_items->description }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="pt-2">
                            <button type="submit" class="btn btn-primary">
                                Update</button>
                        </div>
                </form>
            </div>
        </div>

        @include('backend/theme/clasic/include/modal_photos/modal')
    </div>
@endsection
