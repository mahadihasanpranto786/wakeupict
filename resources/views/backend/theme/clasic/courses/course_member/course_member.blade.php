@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Course Members List
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

                        Course Members List</h3>

                    <a href="{{ route('courses-list') }}" class="btn btn-secondary  float-right mx-1"><i
                            class="fas fa-arrow-left"></i>Course List</a>
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            @if (checkUserType() == 0)
                                <button type="button" class="btn btn-primary my-2" data-toggle="modal"
                                    data-target="#course_member_add">
                                    <i class="fas fa-plus-circle"></i> Add Course Member
                                </button>
                            @endif
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>কোর্সের নাম</th>
                                        <th>কোর্স মেম্বার</th>
                                        <th>নোট</th>
                                        @if (checkUserType() == 0)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($courseMembers as $item)
                                        <tr>
                                            <td> {{ $serial++ }}</td>
                                            <td>
                                                {{ App\model\Course::find($item->course_id)->course_title }} </td>
                                            <td>
                                                {{ App\User::find($item->member_id)->name }} </td>
                                            <td>
                                                {!! $item->note !!} </td>
                                            @if (checkUserType() == 0)
                                                <td>
                                                    <div>
                                                        {{-- edit --}}

                                                        <button title="Edit" class="btn btn-primary btn-sm"> <a
                                                                class="flex items-center "
                                                                href="{{ url('course-member_edit/' . $item->id) }}"><i
                                                                    class="fas fa-pencil-alt text-white"></i>
                                                            </a>
                                                        </button>

                                                        {{-- delete --}}
                                                        <button title="Delete" class="btn btn-danger btn-sm"><a
                                                                class="flex items-center " id="delete"
                                                                href="{{ url('delete-course-member/' . $item->id) }}"><i
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

        {{-- course_member_add --}}
        <div class="modal fade" id="course_member_add" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h1 class="text-center"> Add Course Member</h1> <br>
                        </div>

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-lg font-medium mr-auto">

                        </h2>
                        <form action="{{ route('store-course-member') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <div class="form-group">
                                <label>Select Menber</label>
                                <a data-toggle="modal" data-target="#course_member"
                                    style="float: right; border-radius: 3px;" class="btn-success text-white">Preview</a>
                                <select name="member_id" data-validation='required' data-placeholder="Select Member"
                                    class="form-control select2 prefix-picture" style="width: 100%;">
                                    <option selected></option>
                                    @foreach ($members as $member)
                                        <option value="{{ $member->id }}"
                                            data-picture="{{ $member->photo != '' ? asset($member->photo) : URL::asset('uploads/profile/demo.jpg') }}">
                                            {{ $member->name }}</option>
                                    @endforeach
                                </select>
                                @error('member_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="note" class="form-label">Description(Note)</label>
                                <textarea type="text" name="note" class="textarea form-control" cols="30" rows="4">{{ old('note') }}</textarea>
                                @error('note')
                                    <span class="text-theme-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary  btn-block  mt-5">Submit</button>
                            </div>
                        </form>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>


                @include('backend/theme/clasic/include/modal_photos/modal')
            </div>
        </div>
    @endsection
