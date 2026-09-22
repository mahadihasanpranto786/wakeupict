@extends('frontend.theme.clasic.frontend_layouts.master_layout')
@foreach ($page_content as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')
    <style>
        span.help-block.form-error {
            color: red;
        }

    </style>

    <!--========================== Services Section ============================-->
    <section class="pt-5 mt-5">
        <div class="py-4 container">
            <h2 class="text-center">{{ __('frontend.student.reg_title') }}</h2>
        </div>
    </section>

    <section class="course__details">
        <div class="container">
            <div class="course__details__need mb-5">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-5">
                            <div class="card-body">
                                <form method="POST" action="{{ route('store-student-form') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <input type="hidden" name="course_fee" value="{{ $course->price }}">
                                    <div class="form-row">
                                        <label for="student_name" class="field_color">{{ __('frontend.student.name') }}</label>
                                        <div class="value">
                                            <div class="input-group">
                                                <input id="student_name" data-validation='required' class="input--style-5"
                                                    type="text" name="student_name" placeholder="{{ __('frontend.student.name_placeholder') }}">
                                                @error('student_name')
                                                    <span class="text-danger font-weight-bold">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row m-b-55 p-0">
                                        <div class="field_color">{{ __('frontend.student.gender') }}</div>
                                        <div class="value">
                                            <div class="row row-space">
                                                <div class="col-6">
                                                    <div class="input-group-desc">
                                                        <label class="radio-container m-r-55">{{ __('frontend.student.male') }}
                                                            <input type="radio" name='gander' checked="checked"
                                                                value="male">
                                                            <span class="checkmark"></span>
                                                            @error('gander')
                                                                <span
                                                                    class="text-danger font-weight-bold">{{ $message }}</span>
                                                            @enderror
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="input-group-desc">
                                                        <label class="radio-container">{{ __('frontend.student.female') }}
                                                            <input type="radio" name='gander' value="female">
                                                            <span class="checkmark"></span>
                                                            @error('female')
                                                                <span
                                                                    class="text-danger font-weight-bold">{{ $message }}</span>
                                                            @enderror
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <label for="fathers_name" class="field_color">{{ __('frontend.student.father_name') }}</label>
                                        <div class="value">
                                            <div class="input-group">
                                                <input id="fathers_name" data-validation='required' class="input--style-5"
                                                    type="text" name="fathers_name" placeholder="{{ __('frontend.student.father_placeholder') }}">
                                                @error('fathers_name')
                                                    <span class="text-danger font-weight-bold">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label for="mothers_name" class="field_color">{{ __('frontend.student.mother_name') }}</label>
                                        <div class="value">
                                            <div class="input-group">
                                                <input class="input--style-5" data-validation='required' type="text"
                                                    name="mothers_name" placeholder="{{ __('frontend.student.mother_placeholder') }}">
                                                @error('mothers_name')
                                                    <span class="text-danger font-weight-bold">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border rounded  p-3">
                                        <h4 class="field_color">{{ __('frontend.student.personal_info') }}</h4>
                                        <div class="form-row m-b-55">
                                            <div class="row row-space">
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="nationality" class="field_color">{{ __('frontend.student.nationality') }}</label>
                                                    <input class="input--style-5" data-validation='required' type="text"
                                                        id="nationality" name="nationality" placeholder="{{ __('frontend.student.nationality_placeholder') }}">
                                                    @error('nationality')
                                                        <span class="text-danger font-weight-bold">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="input-group-desc">
                                                        <label for="national_id_no" class="field_color">{{ __('frontend.student.nid') }}</label>
                                                        <input class="input--style-5" data-validation='required'
                                                            type="number" id="national_id_no" name="national_id_no"
                                                            placeholder="{{ __('frontend.student.nid_placeholder') }}">
                                                        @error('national_id_no')
                                                            <span
                                                                class="text-danger font-weight-bold">{{ $message }}</span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group green-border-focus">
                                                        <label for="present_address" class="field_color">{{ __('frontend.student.present_address') }}</label>
                                                        <textarea class="form-control input--style-5"
                                                            data-validation='required' id="present_address"
                                                            name="present_address" rows="3"
                                                            placeholder="{{ __('frontend.student.present_placeholder') }}"></textarea>
                                                        @error('present_address')
                                                            <span
                                                                class="text-danger font-weight-bold">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group green-border-focus">
                                                        <label for="permanent_address" class="field_color">{{ __('frontend.student.permanent_address') }}</label>
                                                        <textarea class="form-control input--style-5"
                                                            data-validation='required' id="permanent_address"
                                                            name="permanent_address" rows="3"
                                                            placeholder="{{ __('frontend.student.permanent_placeholder') }}"></textarea>
                                                        @error('permanent_address')
                                                            <span
                                                                class="text-danger font-weight-bold">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="input-group-desc">
                                                        <label for="personal_call_no" class="field_color">{{ __('frontend.student.mobile') }}</label>
                                                        <input class="input--style-5" data-validation='required' type="text"
                                                            id="personal_call_no" name="personal_call_no"
                                                            placeholder="{{ __('frontend.student.mobile_placeholder') }}">
                                                        @error('personal_call_no')
                                                            <span
                                                                class="text-danger font-weight-bold">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="input-group-desc">
                                                        <label for="email" data-validation='required'
                                                            class="field_color">{{ __('frontend.student.email') }}</label>
                                                        <input class="input--style-5" type="email" id="email" name="email"
                                                            placeholder="{{ __('frontend.student.email_placeholder') }}">
                                                        @error('email')
                                                            <span
                                                                class="text-danger font-weight-bold">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="input-group-desc">
                                                        <label for="religion" class="field_color">{{ __('frontend.student.religion') }}</label>
                                                        <input class="input--style-5" data-validation='required' type="text"
                                                            id="religion" name="religion" placeholder="{{ __('frontend.student.religion_placeholder') }}">
                                                        @error('religion')
                                                            <span
                                                                class="text-danger font-weight-bold">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="input-group-desc">
                                                        <label for="occupation" class="field_color">{{ __('frontend.student.occupation') }}</label>
                                                        <input class="input--style-5" data-validation='required' type="text"
                                                            id="occupation" name="occupation"
                                                            placeholder="{{ __('frontend.student.occupation_placeholder') }}">
                                                        @error('occupation')
                                                            <span
                                                                class="text-danger font-weight-bold">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="input-group-desc">
                                                        <label for="age" class="field_color">{{ __('frontend.student.dob') }}</label>
                                                        <input id="age" class="input--style-5" data-validation='required'
                                                            type="text" name="age" placeholder="Year-Month-Day">
                                                        @error('age')
                                                            <span
                                                                class="text-danger font-weight-bold">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border rounded p-3 mt-1">
                                        <div class="form-row">
                                            <div class="field_color">{{ __('frontend.student.education') }}</div>
                                            <select data-validation='required' name="educational_qualification"
                                                class="custom-select custom-select-lg mb-3 input--style-5">
                                                <option disabled="disabled" selected="selected">{{ __('frontend.student.choose_option') }}
                                                </option>
                                                <option value="Masters">Masters</option>
                                                <option value="Honers">Honers</option>
                                                <option value="H.S.C">H.S.C</option>
                                                <option value="S.S.C">S.S.C</option>
                                                <option value="Others">Others</option>
                                                @error('educational_qualification')
                                                    <span class="text-danger font-weight-bold">{{ $message }}</span>
                                                @enderror
                                            </select>
                                        </div>
                                        <div class="form-row m-b-55">
                                            <div class="row row-space">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="input-group-desc">
                                                        <label for="result" class="field_color">{{ __('frontend.student.result') }}</label>
                                                        <input class="input--style-5" data-validation='required'
                                                            type="text" id="result" name="result"
                                                            value="{{ old('result') }}" placeholder="{{ __('frontend.student.result_placeholder') }}">
                                                        @error('result')
                                                            <span
                                                                class="text-danger font-weight-bold">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="input-group-desc">
                                                        <label for="passing_year" class="field_color">{{ __('frontend.student.passing_year') }}</label>
                                                        <input class="input--style-5" data-validation='required'
                                                            type="text" id="passing_year" name="passing_year"
                                                            placeholder="{{ __('frontend.student.passing_year_placeholder') }}">
                                                        @error('passing_year')
                                                            <span
                                                                class="text-danger font-weight-bold">{{ $message }}</span>
                                                        @enderror

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button class="btn_s btn--radius-2_s btn--green" type="submit">{{ __('frontend.student.submit_btn') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <img src="{{ URL::asset($course->image) }}" style="height: 200px; width: 100%;"
                                class="img-fluid" alt="course image">
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <i class="fas fa-graduation-cap text-success"></i>
                                &nbsp;&nbsp; {{ __('frontend.student.course_name_label') }} <strong>{{ $course->course_title }}</strong>
                            </li>
                            <li class="list-group-item"><i class="fa fa-money text-success" aria-hidden="true"></i>
                                &nbsp;&nbsp; {{ __('frontend.student.course_fee_label') }} ৳ {{ $course->price }}/-</li>
                            <li class="list-group-item"><i class="fa fa-calendar text-success" aria-hidden="true"></i>
                                &nbsp;&nbsp; {{ __('frontend.student.course_duration_label') }} {{ $course->time_line }}</li>
                            @php
                                $sl = 1;
                            @endphp
                            @foreach ($course_members as $member)
                                <li class="list-group-item"><i class="fa fa-user text-success" aria-hidden="true"></i>
                                    &nbsp;&nbsp; {{ __('frontend.student.instructor_label') }} {{ $sl++ }}. <a href="">
                                        {{ App\User::find($member->member_id)->name }}
                                    </a></li>
                            @endforeach

                            <li class="list-group-item"><i class="fa fa-users text-success" aria-hidden="true"></i>
                                &nbsp;&nbsp;&nbsp;&nbsp; {{ __('frontend.student.batch_capacity_label') }} {{ $course->student_quantity }}
                            </li>

                            {{-- course fassility --}}
                            @foreach ($course_fassilities as $item)
                                <li class="list-group-item"><i class="fa fa-question-circle text-success"
                                        aria-hidden="true"></i>
                                    &nbsp;&nbsp; {{ $item->title }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>

    </section>

    <script>
        // image preview
        function courseImg() {
            // const preview = document.querySelector('#imgThambnail');
            const file = document.querySelector('#my-file').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function(e) {
                // convert image file to base64 string
                // preview.src = reader.result;
                $('#imgStudent').attr('src', e.target.result).width(150).height(200);

            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

@endsection
