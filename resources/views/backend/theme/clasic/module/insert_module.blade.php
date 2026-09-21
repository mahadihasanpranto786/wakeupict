@extends('backend.theme.clasic.module.module_index')

@section('moduleSection')
    <h4 class="text-center font-weight-bold">Insert Module</h4>
    <form role="form" method="POST" action="{{ route('store_module') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="title">Title </label>
            <input required type="text" name="title" class="form-control" placeholder="Enter Title">
            @error('title')
                <span class="text-danger">{{ $massage }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
    </form>
@endsection
