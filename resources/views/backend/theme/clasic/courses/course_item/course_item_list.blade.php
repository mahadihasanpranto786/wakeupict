@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Course Items List
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
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Lists</h3>

                    <a href="{{ route('courses-list') }}" class="btn btn-secondary  float-right mx-1"><i
                            class="fas fa-arrow-left"></i>Course List</a>
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            @if (checkUserType() == 0)
                                <button type="button" class="btn btn-primary my-2" data-toggle="modal"
                                    data-target="#modal-lg">
                                    <i class="fas fa-plus-circle"></i> Add Course Item
                                </button>
                            @endif
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>কোর্সের নাম</th>
                                        <th>টাইটেল</th>
                                        <th>কোর্স সিরিয়াল নংঃ</th>
                                        <th>বিবরণ</th>
                                        @if (checkUserType() == 0)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($course_items as $item)
                                        <tr>
                                            <td style="width: 5%"> {{ $serial++ }}</td>
                                            <td style="width: 20%">
                                                {{ App\model\Course::find($item->course_id)->course_title }} </td>
                                            <td style="width: 15%">{{ $item->item_title }} </td>
                                            <td style="width: 15%">{{ $item->course_order }} </td>
                                            <td style="width: 30%">{!! $item->description !!} </td>
                                            @if (checkUserType() == 0)
                                                <td class="border">
                                                    <div>
                                                        {{-- edit --}}

                                                        <button title="Edit Course" class="btn btn-primary btn-sm"> <a
                                                                class="flex items-center "
                                                                href="{{ url('course-edit-item/' . $item->id) }}"><i
                                                                    class="fas fa-pencil-alt text-white"></i>
                                                            </a>
                                                        </button>
                                                        {{-- delete --}}

                                                        <button title="Delete Course" class="btn btn-danger btn-sm"><a
                                                                class="flex items-center " id="delete"
                                                                href="{{ url('delete-course-item/' . $item->id) }}"><i
                                                                    class="fas fa-trash  text-white"></i></a>
                                                        </button>
                                                    </div>
                                                </td>
                                            @endif
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

        {{-- course item add --}}
        <div class="modal fade" id="modal-lg" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h1 class="text-center"> Add Course Item</h1> <br>
                        </div>

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-lg font-medium mr-auto">
                            {{ $courses->course_title }}
                        </h2>
                        <form action="{{ route('store-course-item') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="course_id" value="{{ $courses->id }}">
                                <a href="javascript:;" data-toggle="modal" data-target="#courser_item_title"
                                    style="float: right; border-radius: 3px;" class="btn-success">Preview</a>
                                <label for="item_title">টাইটেল</label>
                                <input type="text" name="item_title" id="item_title" class="form-control"
                                    placeholder="Title" value="{{ old('item_title') }}">
                                @error('item_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="course_order">কোর্স সিরিয়াল নংঃ</label>
                                <input type="number" name="course_order" id="course_order" class="form-control"
                                    placeholder="Course Order" value="{{ old('course_order') }}">
                                @error('course_order')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">

                                <label for="description">বিবরণ</label>
                                <a href="javascript:;" data-toggle="modal" data-target="#course_item_description"
                                    style="float: right; border-radius: 3px;" class="btn-success">Preview</a>
                                <textarea type="text" name="description" class="textarea form-control" cols="30" rows="4">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- BEGIN: Modal Footer -->
                            <div class="modal-footer text-right">
                                <button type="submit" class="btn btn-primary  btn-block w-20">Insert</button>

                            </div> <!-- END: Modal Footer -->
                        </form>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


        @include('backend/theme/clasic/include/modal_photos/modal')
    </div>
@endsection
