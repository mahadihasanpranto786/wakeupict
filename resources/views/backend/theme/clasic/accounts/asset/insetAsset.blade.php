@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Add Asset
@endsection
{{-- menu active start --}}
@section('account', 'menu-open')

@section('menu_active', 'active')

@section('asset', 'menu-open')

@section('index_asset', 'active bg-info')

@section('add_asset', 'active')
{{-- menu active end --}}
@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Asset</h3>
                </div>
                <div class="row">
                    <div class="col-md-10 offset-1">
                        <div class="card-body">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 id="update_head" class="card-title text-center"> Add Asset</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="{{ route('insertAndUpdateAsset') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="date">Date</label>
                                                    <input type="text" name="date" id="datepicker"
                                                        data-validation='required' class="form-control"
                                                        placeholder="Enter Buy Date" value="{{ old('date') }}">
                                                    @error('date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="asset_name">Asset Name</label>
                                                    <input type="text" name="asset_name" id="asset_name"
                                                        class="form-control" placeholder="Enter title"
                                                        value="{{ old('asset_name') }}" data-validation='required'>
                                                    @error('asset_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="quantity">Quantity</label>
                                                    <input type="number" name="quantity" id="quantity"
                                                        class="form-control" placeholder="Enter Unit Price"
                                                        value="{{ old('quantity') }}" data-validation='required'>
                                                    @error('quantity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    @if (user(Auth::id()) == 1)
                                                        <input type="hidden" name="type" class="type"
                                                            value="Local">
                                                    @elseif (user(Auth::id()) == 2)
                                                        <input type="hidden" name="type" class="type"
                                                            value="Global">
                                                    @else
                                                        <label>Asset Type</label>
                                                        <select name="type" id="type" data-validation='required'
                                                            class="form-control select2" style="width: 100%;">
                                                            <option label="Choose type" selected disabled>Select One
                                                            </option>
                                                            <option value="Local">Local</option>
                                                            <option value="Global">Global</option>
                                                        </select>
                                                        @error('type')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> Asset Type</label>
                                                    <select id="asset_type_id" name="asset_type_id"
                                                        data-validation='required' class="form-control select2"
                                                        style="width: 100%;">
                                                        <option label="Choose title" selected disabled>Select One</option>
                                                        @foreach ($assetTypes as $type)
                                                            <option value="{{ $type->id }}">
                                                                {{ $type->asset_type_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('asset_type_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="unit_price">Unit Price</label>
                                                    <input type="number" name="unit_price" id="unit_price"
                                                        class="form-control" placeholder="Enter Unit Price"
                                                        value="{{ old('unit_price') }}" data-validation='required'>
                                                    @error('unit_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="total_price">Total Price</label>
                                                    <input type="number" name="total_price" id="total_price"
                                                        class="form-control" placeholder="Enter Unit Price"
                                                        value="{{ old('total_price') }}" data-validation='required'
                                                        readonly>
                                                    @error('total_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="remark">Remark</label>
                                            <textarea type="text" name="remark" class="form-control" cols="30" rows="3"
                                                placeholder="Write Some Remark">{{ old('remark') }}</textarea>
                                            @error('remark')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block btn-primary align-top">
                                                Save</button>
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

    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#quantity').keyup(function() {
                var quantity = $(this).val();
                var unit_price = $('#unit_price').val();
                var unit_price = $('#total_price').val(quantity * unit_price);
            });

            $('#unit_price').keyup(function() {
                var unit_price = $(this).val();
                var quantity = $('#quantity').val();
                var unit_price = $('#total_price').val(quantity * unit_price);
            });

        });
    </script>
@endsection
