@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Edit Service
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('service_page', 'menu-open')

@section('menu_active_service', 'active bg-info')

@section('service_create_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('service-update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $service->id }}">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="logo">Select Logo</label>
                            <a href="javascript:;" data-toggle="modal" data-target="#service_logo"
                                style="float: right; border-radius: 3px;" class="btn-success">Preview</a>

                            <select name="logo" data-placeholder="Select One Logo" data-validation='required'
                                class="form-control select2">
                                <option label="Choose Logo" selected disabled>Select One</option>
                                @foreach ($icons as $icon)
                                    <option value="{{ $icon->icon }}"
                                        {{ $icon->icon == $service->logo ? 'selected' : '' }}> {{ $icon->icon }}
                                        ({{ $icon->icon_name }})
                                    </option>
                                @endforeach

                            </select>
                            @error('logo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="title">Title</label><a href="javascript:;" data-toggle="modal"
                                data-target="#service_title" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <input type="text" name="title" id="title" data-validation='required' class="form-control "
                                placeholder="Enter Service Title" value="{{ $service->title }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="order_service">Ordering</label>
                            <input type="number" name="order_service" id="order_service" class="form-control"
                                placeholder="Enter Ordering Number" value="{{ $service->order_service }}"
                                data-validation='required'>
                            @error('order_service')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="description">Description</label><a href="javascript:;" data-toggle="modal"
                                data-target="#service_description" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <textarea type="text" name="description" class="form-control textarea" cols="30"
                                rows="3">{{ $service->description }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="pt-2">
                            <button type="submit" class="btn btn-primary">
                                Update</button>
                        </div>
                </form>
            </div>
        </div>

        @include('backend/theme/clasic/include/modal_photos/modal')
    </div>
@endsection
