@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Edit Loan
@endsection
{{-- menu active start --}}
@section('account', 'menu-open')

@section('menu_active', 'active')

@section('loan', 'menu-open')

@section('loan_active', 'active bg-info')

@section('add_loan', 'active')
{{-- menu active end --}}
@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Loan</h3>
                </div>
                <div class="row">
                    <div class="col-md-6 offset-3">
                        <div class="card-body">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 id="update_head" class="card-title text-center"> Edit Loan</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="{{ route('insertAndUpdateLoan') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $loanData->id }}">
                                    <div class="card-body">

                                        <div class="form-group">
                                            @if (user(Auth::id()) == 1)
                                                <input type="hidden" name="loan_type" id="loan_type"
                                                    value="{{ $loanData->loan_type }}">
                                            @elseif (user(Auth::id()) == 2)
                                                <input type="hidden" name="loan_type" id="loan_type"
                                                    value="{{ $loanData->loan_type }}">
                                            @else
                                                <label>Select Expense Type</label>
                                                <select id="expenseType" name="loan_type" data-validation='required'
                                                    class="form-control select2" style="width: 100%;">
                                                    <option label="Choose type" selected disabled>Select One</option>
                                                    <option value="Local"
                                                        {{ $loanData->loan_type == 'Local' ? 'selected' : '' }}>Local
                                                    </option>
                                                    <option value="Global"
                                                        {{ $loanData->loan_type == 'Global' ? 'selected' : '' }}>Global
                                                    </option>
                                                </select>
                                                @error('loan_type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            @endif

                                        </div>
                                        <div class="form-group">
                                            <label for="date">Date</label>
                                            <input type="text" name="date" id="datepicker" data-validation='required'
                                                class="form-control" placeholder="Enter Date"
                                                value="{{ $loanData->date }}">
                                            @error('date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="finalcial_institute">Finalcial Institute</label>
                                            <input type="text" name="finalcial_institute" id="finalcial_institute"
                                                data-validation='required' class="form-control"
                                                placeholder="Enter Finalcial Institute"
                                                value="{{ $loanData->finalcial_institute }}">
                                            @error('finalcial_institute')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="loan_holder_name">Loan Holder Name</label>
                                            <input type="text" name="loan_holder_name" id="loan_holder_name"
                                                class="form-control" placeholder="Enter Loan Holder Name"
                                                value="{{ $loanData->loan_holder_name }}" data-validation='required'>
                                            @error('loan_holder_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="loan_amount">Loan Amount (tk)</label>
                                            <input type="number" name="loan_amount" id="loan_amount" class="form-control"
                                                placeholder="Enter Loan Amount" value="{{ $loanData->loan_amount }}"
                                                data-validation='required'>
                                            @error('loan_amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="remark">Remark</label>
                                            <textarea type="text" name="remark" class="form-control" cols="30" rows="3"
                                                placeholder="Write Some Remark">{{ $loanData->remark }}</textarea>
                                            @error('remark')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block btn-primary align-top">
                                                Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

@endsection
