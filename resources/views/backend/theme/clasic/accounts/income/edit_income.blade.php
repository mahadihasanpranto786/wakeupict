@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Edit Income
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
                                    <h3 id="update_head" class="card-title text-center"> Edit Income</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="{{ route('update-income') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $income->id }}">
                                    <input type="hidden" id="catId" value="{{ $income->title_id }}">
                                    <div class="card-body">

                                        <div class="form-group">
                                            @if (user(Auth::id()) == 1)
                                                <input type="hidden" name="income_type" id="incomeType" value="Local">
                                            @elseif (user(Auth::id()) == 2)
                                                <input type="hidden" name="income_type" id="incomeType" value="Global">
                                            @else
                                                <label>Select Income Type</label>
                                                <select id="incomeType" name="income_type" data-validation='required'
                                                    class="form-control select2" style="width: 100%;">
                                                    <option label="Choose title" selected disabled>Select One</option>

                                                    <option value="Local"
                                                        {{ $income->income_type == 'Local' ? 'selected' : '' }}>Local
                                                    </option>
                                                    <option value="Global"
                                                        {{ $income->income_type == 'Global' ? 'selected' : '' }}>Global
                                                    </option>

                                                </select>
                                                @error('income_type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            @endif

                                        </div>
                                        <div class="form-group">
                                            <label>Select Category</label>
                                            <select name="title_id" id="title_id" data-validation='required'
                                                class="form-control select2" style="width: 100%;">
                                                <option label="Choose category" selected disabled>Select One</option>
                                            </select>
                                            @error('title_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">

                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                placeholder="Enter title" value="{{ $income->title }}"
                                                data-validation='required'>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="form-group">

                                            <label for="date">Date</label>
                                            <input type="text" name="date" id="datepicker" data-validation='required'
                                                class="form-control" placeholder="Enter Service date"
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
                                            <textarea type="text" name="remark" class="form-control" cols="30" rows="3"
                                                placeholder="Write Some Remark">{{ $income->remark }}</textarea>
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
    <!-- jQuery -->
    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    {{-- expense type name --}}
    <script>
        $(document).ready(function() {
            $("#incomeType").change(function() {
                var incomeType = $(this).val();
                $.ajax({
                    method: 'POST',
                    type: 'json',
                    data: {
                        incomeType: incomeType
                    },
                    url: "{{ route('income_type_ajax') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $("#title_id").empty();
                        $("#title_id").append(
                            ` <option label="Choose" selected disabled>Select One</option>`
                        );
                        $.each(data, function(index, value) {
                            $("#title_id").append(
                                `<option value="${value.id}">${value.title}</option>`
                            );
                        });
                    },
                    error: function(error) {

                    }

                })
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            var incomeType = $("#incomeType").val();
            var catId = $("#catId").val();
            $.ajax({
                method: 'POST',
                type: 'json',
                data: {
                    incomeType: incomeType
                },
                url: "{{ route('income_type_ajax') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $("#title_id").empty();
                    $.each(data, function(index, value) {
                        $("#title_id").append(
                            `<option value="${value.id}" ${value.id == catId  ? 'selected': ''}>${value.title}</option>`
                        );
                    });
                },
                error: function(error) {

                }

            })
        })
    </script>
@endsection
