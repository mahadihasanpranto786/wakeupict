@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Assets list
@endsection
{{-- menu active start --}}
@section('account', 'menu-open')

@section('menu_active', 'active')

@section('asset', 'menu-open')

@section('index_asset', 'active bg-info')

@section('assets_list', 'active')
{{-- menu active end --}}
@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Assets list</h3>
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="my-1">
                                @php
                                    $Add_Asset = 0;
                                    $Delete_Asset = 0;
                                    foreach (userRolls() as $roll) {
                                        if ($roll->module_id == 9) {
                                            $Add_Asset = 9;
                                        } elseif ($roll->module_id == 65) {
                                            $Delete_Asset = 65;
                                        }
                                    }
                                @endphp
                                @if ((checkUserType() == 0 && $Add_Asset != 0) || Auth::user()->type == 'Admin')
                                    <a href="{{ URL::to('add-asset') }}">
                                        <button class="btn btn-primary  align-top"><i class="fas fa-plus-circle"></i>
                                            Add Asset</button>
                                    </a>
                                @endif
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">SL</th>
                                        <th style="width: 15%">Asset Name</th>
                                        <th style="width: 15%">Asset Info</th>
                                        <th style="width: 12%">Date</th>
                                        <th style="width: 28%">Remark</th>
                                        @if ((checkUserType() == 0 && $Add_Asset != 0) || Auth::user()->type == 'Admin')
                                            <th style="width: 10%">Action</th>
                                        @elseif((checkUserType() == 0 && $Delete_Asset != 0) || Auth::user()->type == 'Admin')
                                            <th style="width: 10%">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($assets as $asset)
                                        <tr>
                                            <td>{{ $serial++ }}</td>
                                            <td>{{ $asset->asset_name }}</td>
                                            <td>
                                                <strong> Asset Type: </strong>{{ $asset->assetType->asset_type_name }}
                                                <br>
                                                <strong> Type: </strong>{{ $asset->type }}
                                                <br>
                                                <strong> Unit Price: </strong>{{ $asset->unit_price }} <br>
                                                <strong> Quantity: </strong> {{ $asset->quantity }} <br>
                                                <strong> Total Price: </strong> {{ $asset->total_price }} Tk<br>
                                            </td>
                                            <td>{{ dateformater($asset->date)->format('d F, Y') }}</td>
                                            <td>{{ $asset->remark }}</td>
                                            <td>
                                                @if ((checkUserType() == 0 && $Add_Asset != 0) || Auth::user()->type == 'Admin')
                                                    <a href="{{ url('edit-asset/' . $asset->id) }}">
                                                        <button class="btn btn-primary btn-sm">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button></a>
                                                @endif
                                                @if ((checkUserType() == 0 && $Delete_Asset != 0) || Auth::user()->type == 'Admin')
                                                    <a id="delete" href="{{ url('delete-asset/' . $asset->id) }}">
                                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $assets->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
@endsection
