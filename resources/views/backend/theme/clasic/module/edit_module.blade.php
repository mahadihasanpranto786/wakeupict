@extends('backend.theme.clasic.module.module_index')

@section('moduleSection')
    <h4 class="text-center font-weight-bold">Edit Module</h4>
    <form role="form" method="POST" action="{{ route('update_module') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <input type="hidden" name="id" value="{{ $moduleData->id }}">
        <div class="form-group">
            <label for="title">Title </label>
            <input required type="text" name="title" class="form-control" placeholder="Enter Title"
                value="{{ $moduleData->title }}">
            @error('title')
                <span class="text-danger">{{ $massage }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-flat">Update</button>
    </form>
@endsection
