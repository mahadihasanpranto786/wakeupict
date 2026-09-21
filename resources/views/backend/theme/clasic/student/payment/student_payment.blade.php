@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Student Payment
@endsection
{{-- menu active start --}}
@section('student_active', 'menu-open')

@section('menu_active_active', 'active')

@section('admited_student_list', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Student Payment
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="card col-md-4" style="width: 14rem;">
                            <img class="card-img-top" width="200" height="250" src="{{ asset($student->student_photo) }}"
                                alt="Card image cap">
                        </div>
                        <div class="card mx-2 col-md-7">
                            <div class="card-body">
                                <h4 class="card-text">
                                    <strong>Name: </strong><i> {{ $student->student_name }}</i>
                                </h4>
                                <strong>Course:
                                    <small>{{ App\model\Course::find($student->course_id)->course_title }}</small>
                                </strong>
                                <strong class="card-text">Course Fee: </strong>
                                {{ $student->course_fee }} TK<br>
                                @if ($student->course_fee != $student->course_after_discount)
                                    <strong class="card-text">Course After Discount: </strong>
                                    {{ $student->course_after_discount }} TK<br>
                                @endif
                                <strong>Batch Number: </strong>
                                {{ App\model\Batch::find($student->batch_id)->batch_number }}<br>

                                <strong>Mobile: </strong>
                                {{ $student->personal_call_no }}<br>

                                <strong>NID: </strong>
                                {{ $student->national_id_no }}<br>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title text-center">Payment</h3>
                        </div>
                        <!-- form start -->
                        <form method="POST" action="{{ route('student_payment') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                            <input type="hidden" name="course_id" value="{{ $student->course_id }}">
                            <input type="hidden" name="batch_id" value="{{ $student->batch_id }}">
                            <input type="hidden" name="mobile" value="{{ $student->personal_call_no }}">
                            <div class="p-2">
                                <div class="form-group">
                                    <label for="date"> Date </label>
                                    <input class="form-control datepicker" name="date" type="text" placeholder="Enter Date"
                                        data-validation='required'>
                                </div>

                                <div class="form-group">
                                    <label for="remark"> Remark </label>
                                    <textarea class="form-control" id="remark" name="remark" type="text" placeholder="Enter Remark"
                                        data-validation='required'></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="amount"> Amount </label>
                                    <input class="form-control" id="amount" name="amount" type="number"
                                        placeholder="Enter Amount" data-validation='required'>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-block btn-primary align-top"><i class="fab fa-paypal"></i>
                                        Pay</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('backend/theme/clasic/include/modal_photos/modal')
    </div>
@endsection
