@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Sliders List
@endsection
{{-- menu active start --}}

@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('home_page', 'menu-open')

@section('menu_active_home', 'active bg-info')

@section('home_list', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Sliders</h3>

                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            @if (checkUserType() == 0)
                                <a href="{{ route('home-slider') }}">
                                    <button class="btn btn-primary mb-1 align-top"><i class="fas fa-plus-circle"></i> Add
                                        Slider</button>
                                </a>
                            @endif
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Slider Image</th>
                                        <th>Slider Alt</th>
                                        <th>Status</th>
                                        @if (checkUserType() == 0)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($homeSliders as $slider)
                                        <tr>
                                            <td> {{ $serial++ }}</td>
                                            <td>
                                                <img width="100px" style="border-radius: 6px; object-fit: cover; max-height: 60px;" src="{{ safe_asset($slider->slider_image) }}"
                                                    alt="slider image">
                                            </td>
                                            <td>{{ $slider->slider_alt }}
                                            </td>
                                            <td>
                                                @if ($slider->slider_active == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            @if (checkUserType() == 0)
                                                <td class="border">
                                                    {{-- status --}}
                                                    @if ($slider->slider_active == 1)
                                                        <button title="Inactive" class="btn btn-danger btn-sm"> <a
                                                                class="flex items-center "
                                                                href="{{ url('slider-inactive/' . $slider->id) }}"> <i
                                                                    class="fas fa-arrow-circle-down text-white"></i></a>
                                                        </button>
                                                    @else
                                                        <button title="Active" class="btn btn-success btn-sm"> <a
                                                                class="flex items-center "
                                                                href="{{ url('slider-active/' . $slider->id) }}"> <i
                                                                    class="fas fa-arrow-circle-up text-white"></i></a>
                                                        </button>
                                                    @endif
                                                    {{-- edit --}}
                                                    <button title="Edit" class="btn btn-primary btn-sm"> <a
                                                            class="flex items-center "
                                                            href="{{ url('home-slider/slider-edit/' . $slider->id) }}"><i
                                                                class="fas fa-pencil-alt text-white"></i>
                                                        </a>
                                                    </button>

                                                    {{-- delete --}}
                                                    <button title="Delete" class="btn btn-danger btn-sm"><a
                                                            class="flex items-center " id="delete"
                                                            href="{{ url('delete-slider/' . $slider->id) }}"><i
                                                                class="fas fa-trash  text-white"></i></a>
                                                    </button>

                                                </td>
                                            @endif
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
