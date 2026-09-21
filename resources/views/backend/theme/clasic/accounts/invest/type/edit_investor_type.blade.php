@extends('backend.theme.clasic.accounts.invest.type.index_investor_type')

@section('investTypeSection')
    <div class="card-body">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title text-center">Edit Investor Type</h3>
            </div>
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('update-investor-type') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $investor_type_data->id }}">
                <div class="card-body">
                    <div class="form-group">
                        <label for="investor_type_name">Investor Type Name</label>
                        <input class="form-control" id="investor_type_name" name="investor_type_name" type="text"
                            placeholder="Enter name" data-validation='required'
                            value="{{ $investor_type_data->investor_type_name }}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary align-top">
                            Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
