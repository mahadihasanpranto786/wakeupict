@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Edit Student
@endsection
{{-- menu active start --}}
@section('student_active', 'menu-open')

@section('menu_active_active', 'active')

@section('student_list_active', 'active')
{{-- menu active end --}}

@section('maincontant')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('update-student') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $student->id }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="student_name">Student Name</label>
                            <input type="text" data-validation='required' name="student_name" id="student_name"
                                class="form-control" placeholder="Course Title" value="{{ $student->student_name }}">
                            @error('student_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="fathers_name">Fathers Name</label>
                            {{-- <a href="javascript:;" data-toggle="modal"
                            data-target="#time" style="float: right; border-radius: 3px;" class="btn-success">Preview</a> --}}
                            <input type="text" data-validation='required' name="fathers_name" id="fathers_name"
                                class="form-control" placeholder="Time Line" value="{{ $student->fathers_name }}">
                            @error('fathers_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="mothers_name">Mothers Name</label>
                            {{-- <a href="javascript:;" data-toggle="modal"
                            data-target="#time" style="float: right; border-radius: 3px;" class="btn-success">Preview</a> --}}
                            <input type="text" data-validation='required' name="mothers_name" id="mothers_name"
                                class="form-control" placeholder="Time Line" value="{{ $student->mothers_name }}">
                            @error('mothers_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="religion">Religion</label>
                            {{-- <a href="javascript:;" data-toggle="modal" data-target="#time"
                            style="float: right; border-radius: 3px;" class="btn-success">Preview</a> --}}
                            <input type="text" data-validation='required' name="religion" id="religion"
                                class="form-control" placeholder="Time Line" value="{{ $student->religion }}">
                            @error('religion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="occupation">Occupation</label>
                            {{-- <a href="javascript:;" data-toggle="modal"
                            data-target="#time" style="float: right; border-radius: 3px;" class="btn-success">Preview</a> --}}
                            <input type="text" data-validation='required' name="occupation" id="occupation"
                                class="form-control" placeholder="Time Line" value="{{ $student->occupation }}">
                            @error('occupation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="age">Age</label>
                            {{-- <a href="javascript:;" data-toggle="modal" data-target="#time"
                            style="float: right; border-radius: 3px;" class="btn-success">Preview</a> --}}
                            <input type="date" data-validation='required' name="age" id="age" class="form-control"
                                placeholder="Time Line" value="{{ $student->age }}">
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
                        <div class="form-group">
                            <label for="personal_call_no">Personal Call No</label>
                            <input type="number" data-validation='required' name="personal_call_no" id="personal_call_no"
                                class="form-control" placeholder="enter personal numbner"
                                value="{{ $student->personal_call_no }}">
                            @error('personal_call_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="present_address">Present Address</label>
                            <textarea type="text" data-validation='required' name="present_address"
                                class="textarea form-control" cols="30"
                                rows="4">{{ $student->present_address }}</textarea>
                            @error('present_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>
                    <div class="col-md-6">


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
                            <label for="nationality">Nationality</label>
                            <input type="text" data-validation='required' name="nationality" id="nationality"
                                class="form-control" placeholder="Time Line" value="{{ $student->nationality }}">
                            @error('nationality')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="national_id_no">National Id No</label> <input type="text" data-validation='required'
                                name="national_id_no" id="national_id_no" class="form-control" placeholder="Time Line"
                                value="{{ $student->national_id_no }}">
                            @error('national_id_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" data-validation='required' name="email" id="email" class="form-control"
                                placeholder="Price" value="{{ $student->email }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="result">Result</label>
                            <input type="text" data-validation='required' name="result" id="result" class="form-control"
                                placeholder="Time Line" value="{{ $student->result }}">
                            @error('result')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="passing_year">Passing Year</label>
                            <input type="text" data-validation='required' name="passing_year" id="passing_year"
                                class="form-control" placeholder="Time Line" value="{{ $student->passing_year }}">
                            @error('passing_year')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label>Select Course</label>
                            <select name="course_id" data-validation='required' class="form-control select2"
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
                        <div>
                            <label for="permanent_address">Permanent Address</label>
                            <textarea type="text" data-validation='required' name="permanent_address"
                                class="textarea form-control" cols="30"
                                rows="4">{{ $student->permanent_address }}</textarea>
                            @error('permanent_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn btn-primary">
                            Insert</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
