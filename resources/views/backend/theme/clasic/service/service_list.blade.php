@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Service List
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('service_page', 'menu-open')

@section('menu_active_service', 'active bg-info')

@section('service_list_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Lists</h3>
                </div>
                @php
                    $Add_Service = 0;
                    $Delete_Service = 0;
                    foreach (userRolls() as $roll) {
                        if ($roll->module_id == 43) {
                            $Add_Service = 43;
                        } elseif ($roll->module_id == 73) {
                            $Delete_Service = 73;
                        }
                    }
                @endphp
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            @if ((checkUserType() == 0 && $Add_Service != 0) || Auth::user()->type == 'Admin')
                                <a href="{{ route('service-insert') }}">
                                    <button class="btn btn-primary  align-top my-2"><i class="fas fa-plus-circle"></i>Add
                                        Service
                                    </button>
                                </a>
                            @endif
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Logo</th>
                                        <th>Title</th>
                                        <th>Ordering</th>
                                        <th>Description</th>
                                        @if (checkUserType() == 0)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($services as $service)
                                        <tr>
                                            <td> {{ $serial++ }}</td>
                                            <td><i class="{{ $service->logo }}"></i>
                                            </td>
                                            <td>{{ $service->title }} </td>
                                            <td>{{ $service->order_service }}
                                            </td>
                                            <td>{!! $service->description !!} </td>
                                            <td>
                                                <div class="d-flex">
                                                    @if ((checkUserType() == 0 && $Add_Service != 0) || Auth::user()->type == 'Admin')
                                                        <button title="Edit" class="btn btn-primary btn-sm"> <a
                                                                class="flex items-center "
                                                                href="{{ url('edit-service/' . $service->id) }}"><i
                                                                    class="fas fa-pencil-alt text-white"></i>
                                                            </a>
                                                        </button>
                                                    @endif
                                                    @if ((checkUserType() == 0 && $Delete_Service != 0) || Auth::user()->type == 'Admin')
                                                        {{-- delete --}}
                                                        <button title="Delete" class="btn btn-danger btn-sm"><a
                                                                class="flex items-center " id="delete"
                                                                href="{{ url('delete-service/' . $service->id) }}"><i
                                                                    class="fas fa-trash  text-white"></i></a>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

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
@endsection
