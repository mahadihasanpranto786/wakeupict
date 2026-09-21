@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Edit Course Member
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
                <div class="card-body">

                    <form action="{{ route('update-course-member') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $courseMember->id }}">
                        <div>

                            <label>Select Menber</label><a href="javascript:;" data-toggle="modal"
                                data-target="#course_member" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <select name="member_id" data-placeholder="Select One Item" class="form-control">
                                <option label="Choose one" selected disabled>Select One</option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}"
                                        {{ $member->id == $courseMember->member_id ? 'selected' : '' }}>
                                        {{ $member->name }}</option>
                                @endforeach

                            </select>
                            @error('member_id')
                                <span class="text-center">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="note">Description(Note)</label>
                            <textarea type="text" name="note" class="textarea form-control" cols="30" rows="4">{{ $courseMember->note }}</textarea>
                            @error('note')
                                <span class="text-center">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="btn btn-primary">
                                Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @include('backend/theme/clasic/include/modal_photos/modal')
    </div>
@endsection
