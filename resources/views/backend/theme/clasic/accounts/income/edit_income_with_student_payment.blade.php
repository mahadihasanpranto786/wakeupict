@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Edit Student Payment Income
@endsection
{{-- menu active start --}}
@section('income', 'menu-open')

@section('income_menu', 'active bg-info')

@section('account', 'menu-open')

@section('menu_active', 'active')

@section('income_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 offset-3">
                        <div class="card-body">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 id="update_head" class="card-title text-center"> Edit Student Payment Income</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="{{ route('update-income-with-student-payment') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $income->id }}">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="date">Date</label>
                                            <input type="text" name="date" id="datepicker" data-validation='required'
                                                class="form-control" placeholder="Enter date"
                                                value="{{ $income->date }}">
                                            @error('date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="amount">Amount</label>
                                            <input type="number" name="amount" id="amount" class="form-control"
                                                placeholder="Enter amount" value="{{ $income->amount }}"
                                                data-validation='required'>
                                            @error('amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="remark">Remark</label>
                                            <textarea type="text" name="remark" class="form-control" cols="30" rows="3">{{ $income->remark }}</textarea>
                                            @error('remark')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-block btn-primary align-top">
                                            Update</button>
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
