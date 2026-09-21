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
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">

                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    Excel Inport and Excel
                                    <a class="float-right" href="{{ route('free-templete') }}">
                                        <button class="btn btn-warning text-white  align-top">{{-- <i
                                                class="fas fa-plus-circle"></i> --}}
                                            Download Free Templete
                                        </button>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
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
                                        <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>
                                    </form>
                                </div>
                                <p class="text-danger p-3">Before Inport file, Download the free templete first.</p>
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
