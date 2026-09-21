@extends('backend.theme.clasic.module.module_index')

@section('moduleSection')
    <div class="my-2">
        <h4 class="text-center font-weight-bold">Edit Sub Module</h4>
        <form role="form" method="POST" action="{{ route('store_update_sub_module') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <input type="hidden" name="id" value="{{ $moduleData->id }}">
            <div class="form-group">
                <label>Module</label>
                <select name="parents" class="form-control select2" style="width: 100%;">
                    <option selected="selected">Select Module</option>
                    @foreach ($parent_modules as $parent)
                        <option value="{{ $parent->id }}" {{ $parent->id == $moduleData->parents ? 'selected' : '' }}>
                            {{ $parent->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">Sub Module </label>
                <input required type="text" name="title" class="form-control" placeholder="Enter Sub Module"
                    value="{{ $moduleData->title }}">
                @error('title')
                    <span class="text-danger">{{ $massage }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-flat">Update</button>
        </form>
    </div>
@endsection
