@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Excel Import and Export
@endsection


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Lists</h3>
                    <a class="float-right" href="{{ route('insert-student') }}">
                        <button class="btn btn-primary  align-top"><i class="fas fa-plus-circle"></i>Insert Student
                        </button>
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">

                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    Excel Inport and Excel data
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('import-data') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="fomr-group">
                                            <input {{-- data-validation='required' --}} type="file" name="file_excel"
                                                class="form-control">
                                        </div>
                                        @error('file_excel')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror


                                        <br>
                                        <button class="btn btn-success" type="submit">Import User Data</button>
                                    </form>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Excel Update Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                    $serial = 1;
                                                @endphp
                                                @foreach ($excel_names as $excel_name)
                                                    <tr>
                                                        <td> {{ $serial++ }}</td>
                                                        <td>{{ $excel_name->date }}
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-warning"
                                                                href="{{ url('export-data/' . $excel_name->id) }}">Download</a>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
