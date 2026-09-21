@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Talent Hunt Page
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('Talent', 'menu-open')

@section('Talent_active', 'active bg-info')

@section('talent-page-list', 'active')
{{-- menu active end --}}


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
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 20%">Title</th>
                                        <th style="width: 60%">Description</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if ($post)
                                        <tr>
                                            <td>{{ $post->title }}</td>
                                            <td>{!! $post->description !!}</td>

                                            <td class="d-flex">
                                                {{-- view --}}

                                                @if ($post->status == 1)
                                                    <a title="View" class="btn btn-danger btn-sm flex items-center"
                                                        href="{{ url('inactive-talent-page/' . $post->id) }}">
                                                        <i class="fas fa-arrow-down"></i>
                                                    </a>
                                                @else
                                                    <a title="View" class="btn btn-primary btn-sm flex items-center"
                                                        href="{{ url('active-talent-page/' . $post->id) }}">
                                                        <i class="fas fa-arrow-up"></i>
                                                    </a>
                                                @endif

                                                {{-- delete --}}
                                                <a title="Delete" class="btn btn-danger btn-sm flex items-center "
                                                    id="delete" href="{{ url('delete-talent-page/' . $post->id) }}"><i
                                                        class="fas fa-trash  text-white"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
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
