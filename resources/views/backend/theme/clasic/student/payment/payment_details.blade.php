@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Student Payments
@endsection
{{-- menu active start --}}
@section('student_active', 'menu-open')

@section('menu_active_active', 'active')

@section('admited_student_list', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Lists</h3>
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th style="width: 19%">Student Info</th>
                                        <th style="width: 25%">Course Info</th>
                                        <th style="width: 11%">Paid Date</th>
                                        <th style="width: 13%">Amount(TK)</th>
                                        <th style="width: 21%">Remark</th>
                                        @if (checkUserType() == 0)
                                            <th style="width: 16%">Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($paymentDetails as $payment)
                                        <tr>
                                            <td> {{ $serial++ }}</td>

                                            <td>
                                                <strong>Name: </strong>
                                                {{ $payment->student->student_name }} <br>
                                                <strong>Mobile: </strong> {{ $payment->mobile }}
                                            </td>
                                            <td>
                                                <strong>Course: </strong>
                                                {{ $payment->course->course_title }} <br>
                                                <strong>Batch: </strong> {{ $payment->batch->batch_number }}
                                            </td>
                                            <td>{{ Carbon\Carbon::parse($payment->date)->format('d F, Y') }} </td>
                                            <td>Paid: ({{ $payment->paid }}) TK<br>
                                                Return: ({{ $payment->return_money }}) TK<br>
                                                Total: ({{ $payment->paid - $payment->return_money }}) TK</td>
                                            <td>{{ $payment->remark }}</td>

                                            @if (checkUserType() == 0)
                                                <td class="border text-center">
                                                    <div {{-- class="d-flex" --}}>
                                                        {{-- edit --}}
                                                        <button title="Edit Payment" data-toggle="modal"
                                                            data-target="#editPayment{{ $payment->id }}"
                                                            class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i>
                                                        </button>

                                                        {{-- delete --}}
                                                        <a title="Delete payment"
                                                            class="flex items-center btn btn-danger btn-sm" id="delete"
                                                            href="{{ url('delete-payment/' . $payment->id) }}"><i
                                                                class="fas fa-trash  text-white"></i></a>
                                                        {{-- <a title="View" class="flex items-center btn btn-primary btn-sm"
                                                        href="{{ url('payment-view/' . $payment->id) }}"><i
                                                            class="fas fa-eye text-white"></i>
                                                    </a> --}}

                                                    </div>
                                                    <div class="mt-1">
                                                        <button {{-- style="padding: 5px 14px;" --}} title="Payment Return"
                                                            data-toggle="modal"
                                                            data-target=".returnMoney{{ $payment->id }}"
                                                            class="flex items-center btn btn-danger btn-sm"><small>Return
                                                                Money</small>
                                                        </button>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                        {{-- return money --}}
                                        <div class="modal fade returnMoney{{ $payment->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger">
                                                        <h5 class="modal-title" id="exampleModalLabel">Return Money</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- form start -->
                                                        <form method="POST"
                                                            action="{{ route('student_payment_return') }}"
                                                            enctype="multipart/form-data">
                                                            @csrf

                                                            <input type="hidden" name="id" class="paymentId"
                                                                value="{{ $payment->id }}">
                                                            <input type="hidden" name="paidMoney" class="paymentMoney"
                                                                value="{{ $payment->paid }}">
                                                            <div class="p-2">
                                                                <div class="form-group">
                                                                    <label for="date"> Return Date </label>
                                                                    <input class="form-control datepicker"
                                                                        name="return_date" type="text"
                                                                        placeholder="Enter Return Date"
                                                                        data-validation='required'>
                                                                    @error('return_date')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="return_money"> Amount </label>
                                                                    <input class="form-control return_money"
                                                                        name="return_money" type="number"
                                                                        placeholder="Enter Amount"
                                                                        data-validation='required'>
                                                                    @error('return_money')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="return_reason"> Reason </label>
                                                                    <textarea class="form-control return_money" name="return_reason" type="text" placeholder="Enter Return Reason"
                                                                        data-validation='required'></textarea>
                                                                    @error('return_reason')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <button
                                                                        class="btn btn-block btn-primary align-top">Return</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- edit modal --}}
                                        <div class="modal fade" id="editPayment{{ $payment->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Payment</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- form start -->
                                                        <form method="POST"
                                                            action="{{ route('student_payment_update') }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $payment->id }}">
                                                            <div class="p-2">
                                                                <div class="form-group">
                                                                    <label for="date"> Date </label>
                                                                    <input class="form-control datepicker" name="date"
                                                                        type="text" placeholder="Enter Date"
                                                                        data-validation='required'
                                                                        value="{{ $payment->date }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="remark"> Remark </label>
                                                                    <textarea class="form-control" id="remark" name="remark" type="text" placeholder="Enter Remark"
                                                                        data-validation='required'>{{ $payment->remark }}</textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="amount"> Amount </label>
                                                                    <input class="form-control" id="amount" name="amount"
                                                                        type="number" placeholder="Enter Amount"
                                                                        data-validation='required'
                                                                        value="{{ $payment->paid }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <button class="btn btn-block btn-primary align-top"><i
                                                                            class="fab fa-paypal"></i>
                                                                        Update</button>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{ $paymentDetails->links() }}
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
    <!-- jQuery -->
    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    {{-- <script>
        $(document).ready(function() {
            $(".return_money").keyup(function() {
                // var payemtId = $(".paymentId").val();
                var payemtId = $(this).closest(':input').find('.paymentId').val();
                console.log(payemtId);
                var Retrun = $(this).val();
                $.ajax({
                    method: 'POST',
                    type: 'json',
                    data: {
                        payemtId: payemtId
                    },
                    url: "{{ route('student_payment_return_ajax') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        var payment = parseInt(data);
                        console.log(payment);
                        if (payment < Retrun) {
                            $(this).val('');
                            toastr.error("Please Check The Money First!");
                        }
                    },
                    error: function(error) {

                    }

                })


            })

        });
    </script> --}}
@endsection
