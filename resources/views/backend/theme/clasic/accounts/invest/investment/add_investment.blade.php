@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Add Investment
@endsection
{{-- menu active start --}}
@section('account', 'menu-open')

@section('menu_active', 'active')

@section('Invest', 'menu-open')

@section('index_investor_active', 'active bg-info')

@section('investment_list', 'active')
{{-- menu active end --}}
<style>
    span.help-block.form-error {
        color: red;
        font-weight: bold;
    }

</style>

@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 offset-3">
                        <div class="card-body">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 id="update_head" class="card-title text-center">
                                        Add Investment </h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="{{ route('store_investment') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Select Investor</label>
                                            <select name="investor_id" data-validation='required'
                                                class="form-control select2" style="width: 100%;">
                                                <option label="Choose investor" selected disabled>Select One</option>
                                                @foreach ($investors as $investor)
                                                    <option value="{{ $investor->id }}"> {{ $investor->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('investor_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Select Investor Type</label>
                                            <select name="investment_type_id" data-validation='required'
                                                class="form-control select2" style="width: 100%;">
                                                <option label="Choose investor type" selected disabled>Select One</option>
                                                @foreach ($investor_type as $type)
                                                    <option value="{{ $investor->id }}">
                                                        {{ $type->investor_type_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('investment_type_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="date">Date</label>
                                            <input type="text" name="date" id="datepicker" class="form-control"
                                                placeholder="Enter date" value="{{ old('date') }}"
                                                data-validation='required'>
                                            @error('date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="amount">Amount(tk)</label>
                                            <input type="number" name="amount" id="amount" class="form-control"
                                                placeholder="Enter amount" value="{{ old('amount') }}"
                                                data-validation='required'>
                                            @error('amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="rate">Rate</label>
                                            <input type="text" name="rate" id="rate" data-validation='required'
                                                class="form-control" placeholder="Enter  rate"
                                                value="{{ old('rate') }}">
                                            @error('rate')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="remark">Remark</label>
                                            <textarea type="text" placeholder="Add Some Remark..." name="remark" class="form-control" cols="30"
                                                rows="3">{{ old('remark') }}</textarea>
                                            @error('remark')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-block btn-primary align-top">
                                            Submit</button>
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
