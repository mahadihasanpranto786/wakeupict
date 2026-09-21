@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
Talent Hunt Page Create
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('Talent', 'menu-open')

@section('Talent_active', 'active bg-info')

@section('create-talent-content', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <form action="{{ route('store-talent') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-group">
                            <label for="title">Title</label>{{-- <a href="javascript:;" data-toggle="modal"
                                data-target="#service_title" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a> --}}
                            <input type="text" name="title" id="title" data-validation='required' class="form-control"
                                placeholder="Title" value="{{ $post->title ?? old('title') }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="description">Description <span class="text-danger">*</span></label>{{-- <a href="javascript:;" data-toggle="modal"
                                data-target="#service_description" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a> --}}
                            <textarea type="text" name="description" class="form-control textarea" cols="30"
                                rows="3">{{ $post->description ??  old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="pt-2">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
